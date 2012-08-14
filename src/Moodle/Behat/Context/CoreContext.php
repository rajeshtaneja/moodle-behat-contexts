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
     * @Given /^I am logged as a "([^"]*)"$/
     */
    public function iAmLoggedAsA($roleshortname)
    {

        // Check if the role is set
        $usernamefield = $roleshortname . '_username';
        $passwordfield = $roleshortname . '_password';
        if (empty($this->parameters[$usernamefield]) || empty($this->parameters[$passwordfield])) {
            throw new Exception('There is no user for role ' . $roleshortname . ' defined in behat.yml');
        }

        $this->getContext('mink')->visit('login/index.php');
        $this->getContext('mink')->fillField('username', $this->parameters[$usernamefield]);
        $this->getContext('mink')->fillField('password', $this->parameters[$passwordfield]);
        $this->getContext('mink')->pressButton('loginbtn');
    }


    /**
     * @Given /^I wait for (\d+) seconds$/
     */
    public function iWaitForSeconds($seconds)
    {
        $miliseconds = $seconds * 1000 ;
        $this->getSession()->wait($miliseconds);
    }


    /**
     * Shortcut to use all kind of contexts
     *
     * Gets a reference to the requested context following the contexts hierarchy
     *
     * @param string $alias alias of the package
     * @return BehatContext
     */
    protected function getContext($alias) {
        return $this->getMainContext()->getSubcontext($alias);
    }

}
