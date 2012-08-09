<?php

namespace Moodle\Behat\Context;

/**
 * Course context steps definitions
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
        $this->getMainContext()->pressButton('submit');
        $this->getMainContext()->fillField('subject', $this->parameters['stringexample_1']);
        $this->getMainContext()->fillField('id_message', $this->parameters['textexample_1']);
        $this->getMainContext()->pressButton('submitbutton');
    }
}
