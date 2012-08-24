<?php

namespace Moodle\Behat\Context;

use Moodle\Behat\Helper\ScenarioRoute;
use Behat\Behat\Context\Step\When as When;
use Behat\Behat\Context\Step\Given as Given;

/**
 * Moodle blocks steps definitions
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class BlockContext extends BaseContext
{
    /**
     * @Given /^I add the "(?P<blockname>[^"]*)" block$/
     * @todo Add support for other contexts than course
     */
    public function iAddTheBlock($blockname)
    {
        if (!$courseid = ScenarioRoute::get('courseid')) {
            throw new \Exception('No course available to add the ' . $blockname . ' block');
        }

        return array(new Given('I press "Turn editing on"'),
            new Given('I select "' . $blockname . '" from "bui_addblock"'),
            new When('I submit the "add_block" form'));
    }

}