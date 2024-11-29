<?php
function check_login() {
    $ci =& get_instance(); 
    if (!$ci->session->userdata('user_id')) { 
        redirect('login'); 
    }
}

function check_admin() {
    $ci =& get_instance(); 
    if ($ci->session->userdata('role') !== 'admin') { 
        redirect('login'); 
    }
}

function check_user() {
    $ci =& get_instance();
    if ($ci->session->userdata('role') !== 'user') { 
        redirect('login'); 
    }
}
