<?php

namespace Moodle\Behat\Context;

use Behat\Behat\Exception\PendingException;
use Moodle\Behat\Context\BaseContext;
use Behat\Behat\Context\Step\When as When;
use Behat\Behat\Context\Step\Given as Given;
/**
 * Mod_Assign context step definitions
 *
 * @copyright 2012 Tim Barker
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ModAssignContext extends BaseContext {
    /**
     * @Given /^I fill in the form:$/
     * @todo Going to start with text fields, text areas and dropdowns first and
     * then add more features later.
     */
    public function iFillInTheForm(TableNode $table)
    {
        $loctextfield = ".//div[contains(.,'" . $fieldLabel . "')]/div/input";
        $loctextarea = ".//div[contains(.,'" . $fieldLabel . "')]/*/*/*/textarea";
        $locdropdown = ".//*[contains(.,'" . $fieldLabel . "')]/*/select";
        //$loccheckbox = "";
        //$locdate = "";
        //$locdatetime = "";
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