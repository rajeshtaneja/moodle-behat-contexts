<?php
namespace Moodle\Behat\Context;

/**
 * Mod_Assign context step definitions
 *
 * @copyright 2012 Tim Barker
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ModAssignContext extends BaseContext {

    /**
     * @Given /^that I am (a|logged in as a) "([^"]*)"$/
     */
    public function thatIAmA($UserRole)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have been enroled in a course$/
     */
    public function iHaveBeenEnroledInACourse()
    {
        throw new PendingException();
    }

    /**
     * @Given /^an "([^"]*)" has been created$/
     */
    public function anHasBeenCreated($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I am on the assignment page$/
     */
    public function iAmOnTheAssignmentPage()
    {
        throw new PendingException();
    }

    /**
     * @When /^I click on "([^"]*)"$/
     */
    public function iClickOn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I fill in the "([^"]*)" field with "([^"]*)"$/
     */
    public function iFillInTheFieldWith($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should be on the assignment page$/
     */
    public function iShouldBeOnTheAssignmentPage()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I should see the Online text that I entered$/
     */
    public function iShouldSeeTheOnlineTextThatIEntered()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have already made an online text submission with the text "([^"]*)"$/
     */
    public function iHaveAlreadyMadeAnOnlineTextSubmissionWithTheText($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I should see the text "([^"]*)" that I entered$/
     */
    public function iShouldSeeTheTextThatIEntered($arg1)
    {
        throw new PendingException();
    }
}