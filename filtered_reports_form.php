<?php

require_once("{$CFG->libdir}/formslib.php");
require_once($CFG->dirroot.'/blocks/filtered_reports/lib.php');
// Define the class used to display our form
class filtered_reports_form extends moodleform {
 
    function definition() {
 
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', get_string('textfields', 'block_filtered_reports'));

        // add page title element.
        $mform->addElement('text', 'pagetitle', get_string('pagetitle', 'block_filtered_reports'));
        $mform->setType('pagetitle', PARAM_RAW);
        $mform->addRule('pagetitle', null, 'required', null, 'client');
        
        // add display text field
        $mform->addElement('htmleditor', 'displaytext', get_string('displayedhtml', 'block_filtered_reports'));
        $mform->setType('displaytext', PARAM_RAW);
        $mform->addRule('displaytext', null, 'required', null, 'client');
        
        // add filename selection.
        $mform->addElement('filepicker', 'filename', get_string('file'), null, array('accepted_types' => '*'));
        
        // add picture fields grouping
        $mform->addElement('header', 'picfield', get_string('picturefields', 'block_filtered_reports'), null, false);
    
        // add display picture yes / no option
        $mform->addElement('selectyesno', 'displaypicture', get_string('displaypicture', 'block_filtered_reports'));
        $mform->setDefault('displaypicture', 1);

        // add image selector radio buttons
        $images = block_filtered_reports_images();
        $radioarray = array();
        for ($i = 0; $i < count($images); $i++) {
            $radioarray[] =& $mform->createElement('radio', 'picture', '', $images[$i], $i);
        }
        $mform->addGroup($radioarray, 'radioar', get_string('pictureselect', 'block_filtered_reports'), array(' '), FALSE);
    
        // add description field
        $attributes = array('size' => '50', 'maxlength' => '100');
        $mform->addElement('text', 'description', get_string('picturedesc', 'block_filtered_reports'), $attributes);
        $mform->setType('description', PARAM_TEXT);
        
        // add optional grouping
        $mform->addElement('header', 'optional', get_string('optional', 'form'), null, false);
    
        // add date_time selector in optional area
        $mform->addElement('date_selector', 'displaydate', get_string('displaydate', 'block_filtered_reports'), array('optional' => true));
        $mform->setAdvanced('optional');

        // hidden elements
        $mform->addElement('hidden', 'blockid');
        $mform->addElement('hidden', 'courseid');
        $this->add_action_buttons();

        
    }
}