<?php

namespace Moodle\Behat\Context;

use Behat\Behat\Context\BehatContext;

/**
 * Representation of the Moodle contexts
 *
 * It adds all the Moodle components
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class MoodleContext extends BehatContext
{

    /**
     * Loads all the defined Moodle components
     *
     * @throws Exception
     * @param array $parameters behat.yml settings
     */
    public function __construct(array $parameters) {

        $dir = opendir(dirname(__FILE__));
        if (!$dir) {
            throw new \Exception('Moodle contexts can\'t be read');
        }

        // Gets all the moodle contexts
        while (($filename = readdir($dir)) !== false) {

            // Skipping base contexts
            if ($filename == '.' || $filename == '..' ||
                $filename == 'MoodleContext.php' || $filename == 'BaseContext.php') {
                continue;
            }

            // Getting the context id
            $contextname = str_replace('Context.php', '', $filename);

            // Following the moodle frankenstyle format
            $componentname = $this->getFrankenstyleName($contextname);

            // Setting the context as 'moodle' subcontext
            $classname = __NAMESPACE__ . '\\' . ucfirst($contextname) . 'Context';
            $this->useContext($componentname, new $classname($parameters));
        }
    }


    /**
     * Gets a frankenstyled name from the context name
     *
     * Every uppercase letter is replaced by a underscore + the lowercase character
     *
     * @link http://docs.moodle.org/dev/Frankenstyle
     * @param string $contextname
     * @return string
     */
    private function getFrankenstyleName($contextname) {

        // Yes! we are PHP 5.3 compatibles
        $contextname = lcfirst($contextname);

        $componentname = array();
        $chars = str_split($contextname);
        foreach ($chars as $key => $char) {

            // Uppercase character
            if (ord($char) >= 65 && ord($char) <= 90) {
                $componentname[] = '_' . strtolower($char);
            } else {
                $componentname[] = $char;
            }
        }

        return implode('', $componentname);
    }

}