<?php

namespace Moodle\Behat\Context;

/**
 * Steps definition for basic browsing and Moodle actions
 *
 */
class CoreContext extends MinkContext
{

     private $parameters;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
   

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

        $this->visit('login/index.php');
        $this->fillField('username', $this->parameters[$usernamefield]);
        $this->fillField('password', $this->parameters[$passwordfield]);
        $this->pressButton('loginbtn');
    }


    /**
     * @Given /^I wait for (\d+) seconds$/
     */
    public function iWaitForSeconds($seconds)
    {
        $miliseconds = $seconds * 1000 ;
        $this->getSession()->wait($miliseconds);
    }
}
