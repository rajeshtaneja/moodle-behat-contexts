<?php

namespace Moodle\Behat\Context;

/**
 * Steps definition for basic browsing and Moodle actions
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class CoreContext extends BaseContext
{


    /**
     * @Given /^I wait (?P<seconds>\d+) seconds$/
     */
    public function iWaitSeconds($seconds)
    {
        $miliseconds = $seconds * 1000 ;
        $this->getSession()->wait($miliseconds);
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

}
