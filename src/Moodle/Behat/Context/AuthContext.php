<?php

namespace Moodle\Behat\Context;

use Behat\Behat\Context\Step\When as When;

/**
 * Steps definition for login and log out
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class AuthContext extends BaseContext
{

    /**
     * @Given /^I am logged as (a|an) "(?P<roleshortname>[^"]*)"$/
     */
    public function iAmLoggedAsA($roleshortname)
    {

        // Check if the role is set
        $usernamefield = $roleshortname . '_username';
        $passwordfield = $roleshortname . '_password';
        if (empty($this->parameters[$usernamefield]) || empty($this->parameters[$passwordfield])) {
            throw new \Exception('There is no user for role ' . $roleshortname . ' defined in behat.yml');
        }

        return array(new When('I am on "login/index.php"'),
            new When('I fill in "username" with "' . $this->parameters[$usernamefield] . '"'),
            new When('I fill in "password" with "' . $this->parameters[$passwordfield] . '"'),
            new When('I press "loginbtn"'));
    }


    /**
     * @Given /^I log out$/
     */
    public function iLogOut()
    {
        return new When('I follow "Logout"');
    }

}
