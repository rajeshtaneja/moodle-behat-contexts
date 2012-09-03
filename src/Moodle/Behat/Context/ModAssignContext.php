<?php

namespace Moodle\Behat\Context;

use Behat\Behat\Exception\PendingException;
use Moodle\Behat\Context\BaseContext;
use Behat\Gherkin\Node\TableNode;
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
     * Fills in an add/edit form in Moodle.
     */
    public function iFillInTheForm(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $tablerow) {
            //Waits for the submit buttons before running
            $this->getContext('mink')->getSession()->getDriver()->wait(2,'document.getElementById("id_cancel")');
            $fieldlabel = $tablerow['field_name'];
            $value = $tablerow['value'];
            //xpath locator expressions
            $loctextfield = ".//div[contains(.,'" . $fieldlabel . "')]/div/input";
            $loctextarea = ".//div[contains(.,'" . $fieldlabel . "')]/*/*/*/textarea";
            $locdropdown = ".//*[contains(.,'" . $fieldlabel . "')]/*/select";

            //Webdriver locators
            $textfield = $this->getContext('mink')->getSession()->getDriver()->find($loctextfield);
            $textarea = $this->getContext('mink')->getSession()->getDriver()->find($loctextarea);
            $dropdown = $this->getContext('mink')->getSession()->getDriver()->find($locdropdown);
            

            //Construct enter text
            if (!empty($textfield) || !empty($textarea)) {
                $this->getContext('mink')->getSession()->getPage()->fillField($fieldlabel, $value);
            } elseif (!empty($dropdown)) {
                $this->getContext('mink')->getSession()->getPage()->selectFieldOption($fieldlabel, $value);
            } else {
                throw new \Exception('No fields have been filled in');
            }
        }
        
    }
    /**
     * @Given /^I (?:click|click on) "([^"]*)"$/
     */
    public function iClickButton($buttonValue)
    {
        $this->getContext('mink')->getSession()->getPage()->pressButton($buttonValue);
    }

    /**
     * @Then /^the title "([^"]*)" should be displayed$/
     */
    public function theElementShouldBeDisplayed($assignmentTitle)
    {
        $this->getContext('mink')->getSession()->getDriver()->wait(5,NULL);
        $assertTextPresent = $this->getContext('mink')->getSession()->getDriver()->find(".//*[contains(.,'" . $assignmentTitle . "')]");
        if (empty($assertTextPresent))
        {
            throw new \Exception('The text is not present on the screen');
        } else {
            //do nothing
        }
    }

}