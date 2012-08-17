<?php

namespace Moodle\Behat\Helper;

/**
 * Interface to tag contexts used only in background steps definitions
 *
 * This contexts doesn't represent user interactions, so they can not
 * be used as scenarios steps just as background steps to set up the
 * testing environment.
 *
 * Are faster than simulating user interaction because they use the moodle
 * codebase to set up the environment but they can not be part of a black-box
 * testing.
 *
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface BackgroundStep {}
