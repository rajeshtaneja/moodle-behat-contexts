<?php

namespace Moodle\Behat\Context;

/**
 * Forum context steps definitions
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ModForumContext extends BaseContext
{

    /**
     * Adds a discussion with the example data
     *
     * @When /^I add a discussion$/
     */
    public function iAddADiscussion()
    {
        $this->getContext('mink')->pressButton('submit');
        $this->getContext('mink')->fillField('subject', $this->parameters['stringexample_1']);
        $this->getContext('mink')->fillField('id_message', $this->parameters['textexample_1']);
        $this->getContext('mink')->pressButton('submitbutton');
    }

}
