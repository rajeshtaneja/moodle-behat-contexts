<?php

namespace Moodle\Behat\Context;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\TranslatedContextInterface;
use Behat\Behat\Exception\PendingException;

/**
 * Utilities base context
 *
 * All non-features MinkContext methods copied here
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class BaseContext extends RawMinkContext implements TranslatedContextInterface
{

    protected $parameters;

    /**
     * Initializes context.
     * Stores the .yml config file parameters
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }


    /**
     * Returns list of definition translation resources paths.
     *
     * @return array
     */
    public function getTranslationResources()
    {
        return $this->getMinkTranslationResources();
    }

    /**
     * Returns list of definition translation resources paths for this dictionary.
     *
     * @return array
     */
    public function getMinkTranslationResources()
    {
        return glob(__DIR__.'/../../../../i18n/*.xliff');
    }

    /**
     * Locates url, based on provided path.
     * Override to provide custom routing mechanism.
     *
     * @param string $path
     *
     * @return string
     */
    protected function locatePath($path)
    {
        $startUrl = rtrim($this->getMinkParameter('base_url'), '/') . '/';

        return 0 !== strpos($path, 'http') ? $startUrl . ltrim($path, '/') : $path;
    }

    /**
     * Returns fixed step argument (with \\" replaced back to ").
     *
     * @param string $argument
     *
     * @return string
     */
    protected function fixStepArgument($argument)
    {
        return str_replace('\\"', '"', $argument);
    }


    /**
     * Shortcut to use all kind of contexts
     *
     * Gets a reference to the requested context following the contexts hierarchy
     *
     * @todo Externalize method together with BaseContext->getContext
     * @param string $alias alias of the package
     * @return BehatContext
     */
    protected function getContext($alias) {
        return $this->getMainContext()->getSubcontext($alias);
    }


    /**
     * Based on AbstractWebDriver->curl uses reflection to access the protected method
     *
     * @todo Reflection is expensive, store the reflection method
     * @param string $requestMethod HTTP request method, e.g., 'GET', 'POST', or 'DELETE'
     * @param string $command       If not defined in methods() this function will throw.
     * @param array $parameters     If an array(), they will be posted as JSON parameters
     *                               If a number or string, "/$params" is appended to url
     * @param array $extraOptions   key=>value pairs of curl options to pass to curl_setopt()
     * @return array array('value' => ..., 'info' => ...)
     */
    protected function WebDriverCall($requestMethod, $command, $parameters = null, $extraOptions = array()) {

        // Getting the webdriver session from the selenium2 driver in use
        $wdsession = $this->getContext('mink')->getSession()->getDriver()->wdSession;
        $curlmethod = new \ReflectionMethod($wdsession, 'curl');
        $curlmethod->setAccessible(true);

        $arguments = array($requestMethod, $command, $parameters, $extraOptions);

        return $curlmethod->invokeArgs($wdsession, $arguments);
    }


    /**
     * Returns the element id
     *
     * Useful for web driver calls to session/:sessionid/elementid/actionname
     *
     * @throws Exception If $id not found
     * @param string $id
     * @return integer The element id
     */
    protected function getElementId($id) {

        $pageelement = $this->getContext('mink')->getSession()->getPage()->findById($id);
        if (!$pageelement) {
            throw new \Exception('Element with id ' . $id . ' not found');
        }

        $xpath = $pageelement->getXpath();
        $element = $this->getContext('mink')->getSession()->getDriver()->wdSession->element('xpath', $xpath);

        return $element->getID();
    }
    /**
     * Waits $timetowait seconds for an xpath expression to return true. 
     * This makes test more robust and less likely to break. It can be used
     * in conjunction with mink locators by returning the xpath to a var.
     * @param type $xpath The xpath to be evaluated.
     * @param type $timetowait The time to wait in seconds for the xpath to return
     * True.
     * @throws \Exception Throws a descriptive exception when the test fails.
     */
    protected function explicitWait($xpath, $timetowait) {
        for ($counter = 1; $counter <=$timetowait; $counter++)
        {
            $element = $this->getContext('mink')->getSession()->getDriver()->find($xpath);
            $this->getContext('mink')->getSession()->getDriver()->wait(1000, null);
            if (!empty($element)) break;
        }
    }
}
