<?php


function block_filtered_reports_images() {
    return array(html_writer::tag('img', '', array('alt' => get_string('red', 'block_filtered_reports'), 'src' => "pix/pic1.png")),
                html_writer::tag('img', '', array('alt' => get_string('blue', 'block_filtered_reports'), 'src' => "pix/pic2.png")),
                html_writer::tag('img', '', array('alt' => get_string('green', 'block_filtered_reports'), 'src' => "pix/pic3.png")));
}