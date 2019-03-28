<?php

require_once("{$CFG->libdir}/formslib.php");
 
class filtered_reports_form extends moodleform {
 
    function definition() {
 
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', get_string('textfields', 'block_filtered_reports'));
    }
}