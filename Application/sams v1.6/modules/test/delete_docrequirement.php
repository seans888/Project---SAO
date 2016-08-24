<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Delete docrequirement');

if(isset($_GET['id']))
{
    $id = urldecode($_GET['id']);
    require_once 'form_data_docrequirement.php';
}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_delete']);
    require 'components/query_string_standard.php';

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_docrequirement.php?$query_string");
    }

    elseif($_POST['btn_delete'])
    {
        log_action('Pressed delete button');
        require_once 'subclasses/docrequirement.php';
        $dbh_docrequirement = new docrequirement;

        $object_name = 'dbh_docrequirement';
        require 'components/create_form_data.php';

        $dbh_docrequirement->delete($arr_form_data);


        redirect("listview_docrequirement.php?$query_string");
    }
}
require 'subclasses/docrequirement_html.php';
$html = new docrequirement_html;
$html->draw_header('Delete Docrequirement', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);

$html->draw_hidden('id');

$html->detail_view = TRUE;
$html->draw_controls('delete');

$html->draw_footer();