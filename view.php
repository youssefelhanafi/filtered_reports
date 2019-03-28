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

$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$filtered_reports->set_data($toform);

if($filtered_reports->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $id));
    redirect($courseurl);
} else if ($fromform = $filtered_reports->get_data()) {
    // We need to add code to appropriately act on and store the submitted data
    // but for now we will just redirect back to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
    //redirect($courseurl);
    print_object($fromform);
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    echo $OUTPUT->header();
    $filtered_reports->display();
    echo $OUTPUT->footer();
}

// We need to add code to appropriately act on and store the submitted data
if (!$DB->insert_record('block_filtered_reports', $fromform)) {
    print_error('inserterror', 'block_filtered_reports');
}
/* echo $OUTPUT->header();
$filtered_reports->display();
echo $OUTPUT->footer(); */
 
//$filtered_reports->display();
?>