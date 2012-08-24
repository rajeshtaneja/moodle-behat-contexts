<?php

namespace Moodle\Behat\Context;

use Behat\Behat\Exception\PendingException;
/**
 * Mod_Assign context step definitions
 *
 * @copyright 2012 Tim Barker
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ModAssignContext extends BaseContext {

    /**
     * @Given /^that I am logged in as "([^"]*)"$/
     */
    public function thatIAmLoggedInAs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^that I add "([^"]*)" to section "([^"]*)"$/
     */
    public function thatIAddToSection($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I fill in the form:$/
     */
    public function iFillInTheForm(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I click on the "([^"]*)" element$/
     */
    public function iClickOnTheElement($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^the element "([^"]*)" should be displayed$/
     */
    public function theElementShouldBeDisplayed($arg1)
    {
        throw new PendingException();
    }

}