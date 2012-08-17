<?php

namespace Moodle\Behat\Context;

use Moodle\Behat\Helper\BackgroundStep;

/**
 * Basic moodle steps definitions to be used in the background section
 *
 * They uses moodle codebase so they can not be part of black-box tests
 *
 * @todo Set a behat.yml config var with the moodle installation path and fill it with methods
 * @copyright 2012 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class BackgroundCoreContext extends BaseContext implements BackgroundStep {



}