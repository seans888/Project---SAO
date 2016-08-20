<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Edit student affair head');

if(isset($_GET['SAH_Id']))
{
    $SAH_Id = urldecode($_GET['SAH_Id']);
    require 'form_data_student affair head.php';

}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_submit']);
    require 'components/query_string_standard.php';
    require 'subclasses/student affair head.php';
    $dbh_student affair head = new student affair head;

    $object_name = 'dbh_student affair head';
    require 'components/create_form_data.php';

    extract($arr_form_data);

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_student affair head.php?$query_string");
    }


    if($_POST['btn_submit'])
    {
        log_action('Pressed submit button');

        $message .= $dbh_student affair head->sanitize($arr_form_data)->lst_error;
        extract($arr_form_data);

        if($dbh_student affair head->check_uniqueness_for_editing($arr_form_data)->is_unique)
        {
            //Good, no duplicate in database
        }
        else
        {
            $message = "Record already exists with the same primary identifiers!";
        }

        if($message=="")
        {
            $dbh_student affair head->edit($arr_form_data);


            redirect("listview_student affair head.php?$query_string");
        }
    }
}
require 'subclasses/student affair head_html.php';
$html = new student affair head_html;
$html->draw_header('Edit Student Affair Head', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);
$html->draw_hidden('SAH_Id');

$html->draw_controls('edit');

$html->draw_footer();