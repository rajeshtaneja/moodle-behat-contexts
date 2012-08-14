<?php

namespace Moodle\Behat\Context;

/**
 * Course context steps definitions
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class CourseContext extends BaseContext
{

    /**
     * Visits the default course
     *
     * @Given /^I go to a course$/
     */
    public function iGoToACourse()
    {
        $this->getContext('mink')->visit('course/view.php?' . $this->parameters['course_1']);
    }

    /**
     * Visits the settings page of the default course
     * @Given /^I go to the settings page of a course$/
     */
    public function iGoToTheSettingsPageOfACourse()
    {
        if (empty($this->parameters['course_1'])) {
            throw new Exception('There is no course_1 defined in behat.yml');
        }

        $this->iGoToTheSettingsPageOfTheCourse($this->parameters['course_1']);
    }

    /**
     * @Given /^I go to the settings page of the course (\d+)$/
     */
    public function iGoToTheSettingsPageOfTheCourse($courseid)
    {

        $startUrl = rtrim($this->getMinkParameter('base_url'), '/');
        $url = $startUrl . '/course/edit.php?id=' . $courseid;
        $this->getSession()->visit($url);
    }

}
