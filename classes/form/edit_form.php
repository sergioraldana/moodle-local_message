<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ${PLUGINNAME} file description here.
 *
 * @package    ${PLUGINNAME}
 * @copyright  2022 renatoaldana <${USEREMAIL}>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('textarea', 'messagetext', get_string('messagetext', 'local_message')); // Add elements to your form.
        $mform->setType('messagetext', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('messagetext', get_string('messagetext_input', 'local_message'));// Default value.
        $mform->addHelpButton('messagetext', 'messagetext', 'local_message');

        $choices = array();
        $choices['0'] = \core\output\notification::NOTIFY_SUCCESS;
        $choices['1'] = \core\output\notification::NOTIFY_WARNING;
        $choices['2'] = \core\output\notification::NOTIFY_INFO;
        $choices['3'] = \core\output\notification::NOTIFY_ERROR;

        $mform->addElement('select', 'messagetype', get_string('messagetype_input', 'local_message'), $choices);
        $mform->setDefault('messagetype', 2);

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}