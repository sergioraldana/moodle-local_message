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

require_once('../../config.php');
require_once($CFG->dirroot . '/local/message/classes/form/edit_form.php');
global $DB;

$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);

// Set up the page.
$title = get_string('edit');
$pagetitle = $title;
$url = new moodle_url("/local/message/edit.php");
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);

//Instantiate edit_form
$mform = new edit_form();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    // Handle form cancel operation, if cancel button is present on form
    // Redirect to manage.php
    redirect($CFG->wwwroot . '/local/message/manage.php', get_string('editformcancel', 'local_message'));

} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.

    // Insertar los datos en la tabla de la base de datos.
    $recordtoinsert = new stdClass();
    $recordtoinsert->messagetext = $fromform->messagetext;
    $recordtoinsert->messagetype = $fromform->messagetype;

    $DB->insert_record('local_message', $recordtoinsert);

    // Redirect to manage.php
    redirect($CFG->wwwroot . '/local/message/manage.php', get_string('editformcreated', 'local_message') . $fromform->messagetext);

} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    //displays the form
    echo $OUTPUT->header();

    $mform->display();

    echo $OUTPUT->footer();
}

