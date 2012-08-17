<?php

namespace Moodle\Behat\Context;

use Moodle\Behat\Helper\ScenarioRoute;
use Behat\Behat\Context\Step\When as When;

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
     * @Given /^I (go to|am on) a course$/
     */
    public function iGoToACourse()
    {
        if (empty($this->parameters['course_1'])) {
            throw new Exception('There is no course_1 defined in behat.yml');
        }

        // Storing the accessed course
        ScenarioRoute::set('courseid', $this->parameters['course_1']);

        return new When('I go to "course/view.php?id=' . $this->parameters['course_1'] . '"');
    }

    /**
     * Visits the settings page of the default course
     * @Given /^I go to the settings page of a course$/
     */
    public function iGoToTheSettingsPageOfACourse()
    {
        if (empty($this->parameters['course_1'])) {
            throw new Exception('There is no default course defined in behat.yml (course_1 setting)');
        }

        return new When('I go to the settings page of the course ' . $this->parameters['course_1']);
    }

    /**
     * @Given /^I go to the settings page of the course (?P<courseid>\d+)$/
     */
    public function iGoToTheSettingsPageOfTheCourse($courseid)
    {

        // Storing the accessed course
        ScenarioRoute::set('courseid', $courseid);

        return array(new When('I go to "/course/view.php?id=' . $courseid . '"'),
            new When('I follow "Edit settings"'));
    }

    /**
     * @Given /^I go to the grades page of a course$/
     */
    public function iGoToTheGradesPageOfACourse()
    {
        if (empty($this->parameters['course_1'])) {
            throw new Exception('There is no default course defined in behat.yml (course_1 setting)');
        }

        return new When('I go to the grades page of the course ' . $this->parameters['course_1']);
    }

    /**
     * @Given /^I go to the grades page of the course (\d+)$/
     */
    public function iGoToTheGradesPageOfTheCourse($courseid)
    {

        // Storing the accessed course
        ScenarioRoute::set('courseid', $courseid);

        return array(new When('I go to "/course/view.php?id=' . $courseid . '"'),
            new When('I follow "Grades"'));
    }

}
