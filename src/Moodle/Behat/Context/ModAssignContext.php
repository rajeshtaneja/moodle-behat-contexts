<?php

namespace Moodle\Behat\Context;

use Behat\Behat\Exception\PendingException;
use Moodle\Behat\Context\BaseContext;
use Behat\Gherkin\Node\TableNode;
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
     * Fills in an add/edit form in Moodle.
     */
    public function i_fill_in_the_form(TableNode $form_table)
    {
        $hash = $form_table->getHash();
        foreach ($hash as $form_tablerow) {
            
            //Waits for the submit buttons before running
            $loccancel = 'id_cancel';
            $loconscreentext = ".//*[@id='" . $loccancel . "']";
            $timetowait = 30;
            $this->explicitWait($loconscreentext, $timetowait);
            $fieldlabel = $form_tablerow['field_name'];
            $value = $form_tablerow['value'];
            
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
        $loc_value_text = ".//*[@value='" . $buttonValue . "']";
        $timetowait = 30;
        $this->explicitWait($loc_value_text, $timetowait);
        $this->getContext('mink')->getSession()->getPage()->pressButton($buttonValue);
    }
    
    /**
     * @Given /^the button "([^"]*)" should be displayed$/
     */
    public function theButtonShouldBeDisplayed($button_value)
    {
        $loc_value_text = ".//*[@value='" . $button_value . "']";
        $timetowait = 30;
        $this->explicitWait($loc_value_text, $timetowait);
        $assert_value_present = $this->getContext('mink')->getSession()->getDriver()->find($loc_value_text);
        if (empty($assert_value_present))
        {
            throw new \Exception('The text is not present on the screen');
            } elseif (!empty ($assert_value_present)) {
        }
    }

    /**
     * @Then /^the text "([^"]*)" should be displayed$/
     */
    public function the_text_should_be_displayed($text)
    {
        $loconscreentext = ".//*[contains(.,'" . $text . "')]";
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
        //Set the field label to the format used by id's for this field
        $id_string = str_replace(" ", "", lcfirst($field_label));
        //Make sure the field is enabled
        $loc_checkbox = ".//*[@id='id_" . $id_string . "_enabled']";
        $checked = $loc_checkbox . "[@checked='checked']";
        if (empty($checked)) {
            $this->getContext('mink')->getSession()->getPage()->checkField();
        } elseif (!empty($checked)) {
            //Do nothing!
        }
        //Process the table selecting values for each dropdown.
        $hash = $table->getHash();
        foreach ($hash as $tablerow)
        {
            $date_unit = $tablerow['date_unit'];
            $value = $tablerow['value'];
            //Build ID string
            $id = "id_" . $id_string . "date_" . $date_unit;
            //Select the value
            $this->getContext('mink')->getSession()->getPage()->selectFieldOption($id, $value);
        }
    }
    
    /**
     * @Given /^I goto the "([^"]*)" form from section "([^"]*)" as a "([^"]*)"$/
     */
    public function i_goto_the_form_as_a($activity, $section, $role)
    {
        return array(new Given('I have logged in as a "'. $role . '"'),
        new Given('I go to a course'),
        new Given('that I add "' . $activity . '" to section "'. $section . '"'));
    }
    
    /**
     * @Given /^I enter the text "([^"]*)"$/
     */
    public function i_enter_the_text($text_to_enter)
    {
        $online_text_editor = "id_onlinetext_editor";
        $loc_link = ".//*[@id='" . $online_text_editor . "']";
        $timetowait = 30;
        $this->explicitWait($loc_link, $timetowait);
        $this->getContext("mink")->getSession()->getPage()->fillField($online_text_editor, $text_to_enter);
    }
    
    /**
     * @Given /^I am in the Assignment "([^"]*)"$/
     */
    public function iAmInTheAssignment($link_text)
    {
        return array(new Given('I go to a course'), 
            new Given('I click on the "' . $link_text . '" link'));
    }
   
    /**
     * @Given /^I (?:click|click on) the "([^"]*)" link$/
     */
    public function i_click_the_link($link_text)
    {
        $loc_link = ".//a[contains(.,'" . $link_text . "')]";
        $timetowait = 30;
        $this->explicitWait($loc_link, $timetowait);
        $this->getContext('mink')->getSession()->getDriver()->click($loc_link);
    }

}