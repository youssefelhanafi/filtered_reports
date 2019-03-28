<?php
 
require_once('../../config.php');
require_once('filtered_reports_form.php');
 
global $DB, $OUTPUT, $PAGE;
 
// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);
 
// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);

$settingsnode = $PAGE->settingsnav->add(get_string('filtered_reportssettings', 'block_filtered_reports'));
$editurl = new moodle_url('/blocks/filtered_reports/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_filtered_reports'), $editurl);
$editnode->make_active();
 
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_filtered_reports', $courseid);
}
 
require_login($course);

$PAGE->set_url('/blocks/filtered_reports/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_filtered_reports'));
 
$filtered_reports = new filtered_reports_form();

echo $OUTPUT->header();
$filtered_reports->display();
echo $OUTPUT->footer();
 
//$filtered_reports->display();
?>