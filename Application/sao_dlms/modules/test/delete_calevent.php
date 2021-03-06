<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Delete calevent');

if(isset($_GET['id']) && isset($_GET['SAO_SAO_Id']))
{
    $id = urldecode($_GET['id']);
    $SAO_SAO_Id = urldecode($_GET['SAO_SAO_Id']);
    require_once 'form_data_calevent.php';
}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_delete']);
    require 'components/query_string_standard.php';

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_calevent.php?$query_string");
    }

    elseif($_POST['btn_delete'])
    {
        log_action('Pressed delete button');
        require_once 'subclasses/calevent.php';
        $dbh_calevent = new calevent;

        $object_name = 'dbh_calevent';
        require 'components/create_form_data.php';

        $dbh_calevent->delete($arr_form_data);


        redirect("listview_calevent.php?$query_string");
    }
}
require 'subclasses/calevent_html.php';
$html = new calevent_html;
$html->draw_header('Delete Calevent', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);

$html->draw_hidden('id');
$html->draw_hidden('SAO_SAO_Id');

$html->detail_view = TRUE;
$html->draw_controls('delete');

$html->draw_footer();