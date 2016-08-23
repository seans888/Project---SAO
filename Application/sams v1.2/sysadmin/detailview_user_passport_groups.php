<?php
//******************************************************************
//This file was generated by Cobalt, a rapid application development 
//framework developed by JV Roig (jvroig@jvroig.com).
//
//Cobalt on the web: http://cobalt.jvroig.com
//******************************************************************
require 'path.php';
init_cobalt('View user passport groups');

if(isset($_GET['passport_group_id']))
{
    $passport_group_id = urldecode($_GET['passport_group_id']);
    require 'form_data_user_passport_groups.php';
}

if(xsrf_guard())
{
    init_var($_POST['btn_back']);

    if($_POST['btn_back']) 
    {
        log_action('Pressed cancel button');
        require 'components/query_string_standard.php';
        redirect("listview_user_passport_groups.php?$query_string");
    }
}
require 'subclasses/user_passport_groups_html.php';
$html = new user_passport_groups_html;
$html->draw_header('Detail View: User Passport Groups', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);
$html->detail_view = TRUE;

$html->draw_controls('view');

$html->draw_footer();
