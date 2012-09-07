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
    public function i_fill_in_the_form(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $tablerow) {
            
            //Waits for the submit buttons before running
            $loccancel = 'id_cancel';
            $loconscreentext = ".//*[@id='" . $loccancel . "']";
            $timetowait = 30;
            $this->explicitWait($loconscreentext, $timetowait);
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
    public function i_click_button($buttonValue)
    {
        $this->getContext('mink')->getSession()->getPage()->pressButton($buttonValue);
    }

    /**
     * @Then /^the ([^"]*) "([^"]*)" should be displayed$/
     */
    public function the_text_should_be_displayed($assignmentTitle)
    {
        $loconscreentext = ".//*[contains(.,'" . $assignmentTitle . "')]";
        $timetowait = 30;
        $this->explicitWait($loconscreentext, $timetowait);
        $assertTextPresent = $this->getContext('mink')->getSession()->getDriver()->find($loconscreentext);
        if (empty($assertTextPresent))
        {
            throw new \Exception('The text is not present on the screen');
            } elseif (!empty ($assertTextPresent)) {
        }
    }
     /**
     * @Given /^I enter the dates in "([^"]*)":$/
     */
    public function i_enter_the_dates($field_label, TableNode $table)
    {

        //Make sure the field is enabled
        
        //Process the table selecting values for each dropdown.
        $hash = $table->getHash();
        foreach ($hash as $tablerow)
        {
            $date_unit = $tablerow['date_unit'];
            $value = $tablerow['value'];
            //Build ID string
            $date_string = str_replace(" ", "", $field_label);
            $id = "id_" . $date_string . "date_" . $date_unit;
            //Select the value
            $this->getContext('mink')->getSession()->getPage()->selectFieldOption($id, $value);
        }
    }

}