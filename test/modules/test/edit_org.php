<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Edit org');

if(isset($_GET['Org_Id']) && isset($_GET['SAO_SAO_Id']))
{
    $Org_Id = urldecode($_GET['Org_Id']);
    $SAO_SAO_Id = urldecode($_GET['SAO_SAO_Id']);
    require 'form_data_org.php';
    $orig_SAO_SAO_Id = $SAO_SAO_Id;
}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_submit']);
    require 'components/query_string_standard.php';
    require 'subclasses/org.php';
    $dbh_org = new org;

    $object_name = 'dbh_org';
    require 'components/create_form_data.php';
    $arr_form_data['orig_SAO_SAO_Id'] = $_POST['orig_SAO_SAO_Id'];
    extract($arr_form_data);

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_org.php?$query_string");
    }


    if($_POST['btn_submit'])
    {
        log_action('Pressed submit button');

        $message .= $dbh_org->sanitize($arr_form_data)->lst_error;
        extract($arr_form_data);

        if($dbh_org->check_uniqueness_for_editing($arr_form_data)->is_unique)
        {
            //Good, no duplicate in database
        }
        else
        {
            $message = "Record already exists with the same primary identifiers!";
        }

        if($message=="")
        {
            $dbh_org->edit($arr_form_data);


            redirect("listview_org.php?$query_string");
        }
    }
}
require 'subclasses/org_html.php';
$html = new org_html;
$html->draw_header('Edit Org', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);
$html->draw_hidden('Org_Id');
$html->draw_hidden('orig_SAO_SAO_Id');
$html->draw_controls('edit');

$html->draw_footer();