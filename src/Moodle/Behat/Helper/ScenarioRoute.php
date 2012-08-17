<?php

namespace Moodle\Behat\Helper;

/**
 * Keeps the last course, user, activity...
 * the scenario has interacted with to further references
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ScenarioRoute {

    private static $vars;


    /**
     * Stores the value in the static scope
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value) {
        self::$vars[$key] = $value;
    }

    /**
     * Gets the stored var
     *
     * @throws Exception
     * @param unknown_type $key The var we want (a courseid, a userid...)
     * @return mixed The current value
     */
    public static function get($key) {

        if (!isset(self::$vars[$key])) {
            throw new Exception('There is no ' . $key . ' stored in this scenario');
        }

        return self::$vars[$key];
    }

}