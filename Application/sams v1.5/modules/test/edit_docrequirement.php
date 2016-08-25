<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Edit docrequirement');

if(isset($_GET['id']))
{
    $id = urldecode($_GET['id']);
    require 'form_data_docrequirement.php';
    $orig_id = $id;
}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_submit']);
    require 'components/query_string_standard.php';
    require 'subclasses/docrequirement.php';
    $dbh_docrequirement = new docrequirement;

    $object_name = 'dbh_docrequirement';
    require 'components/create_form_data.php';
    $arr_form_data['orig_id'] = $_POST['orig_id'];
    extract($arr_form_data);

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_docrequirement.php?$query_string");
    }


    if($_POST['btn_submit'])
    {
        log_action('Pressed submit button');

        $message .= $dbh_docrequirement->sanitize($arr_form_data)->lst_error;
        extract($arr_form_data);

        if($dbh_docrequirement->check_uniqueness_for_editing($arr_form_data)->is_unique)
        {
            //Good, no duplicate in database
        }
        else
        {
            $message = "Record already exists with the same primary identifiers!";
        }

        if($message=="")
        {
            $dbh_docrequirement->edit($arr_form_data);


            redirect("listview_docrequirement.php?$query_string");
        }
    }
}
require 'subclasses/docrequirement_html.php';
$html = new docrequirement_html;
$html->draw_header('Edit Docrequirement', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);

$html->draw_hidden('orig_id');
$html->draw_controls('edit');

$html->draw_footer();