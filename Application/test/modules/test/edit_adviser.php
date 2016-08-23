<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Edit adviser');

if(isset($_GET['Adv_Id']) && isset($_GET['Org_Org_Id']) && isset($_GET['Org_SAO_SAO_Id']))
{
    $Adv_Id = urldecode($_GET['Adv_Id']);
    $Org_Org_Id = urldecode($_GET['Org_Org_Id']);
    $Org_SAO_SAO_Id = urldecode($_GET['Org_SAO_SAO_Id']);
    require 'form_data_adviser.php';
    $orig_Org_Org_Id = $Org_Org_Id;
    $orig_Org_SAO_SAO_Id = $Org_SAO_SAO_Id;
}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_submit']);
    require 'components/query_string_standard.php';
    require 'subclasses/adviser.php';
    $dbh_adviser = new adviser;

    $object_name = 'dbh_adviser';
    require 'components/create_form_data.php';
    $arr_form_data['orig_Org_Org_Id'] = $_POST['orig_Org_Org_Id'];
    $arr_form_data['orig_Org_SAO_SAO_Id'] = $_POST['orig_Org_SAO_SAO_Id'];
    extract($arr_form_data);

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_adviser.php?$query_string");
    }


    if($_POST['btn_submit'])
    {
        log_action('Pressed submit button');

        $message .= $dbh_adviser->sanitize($arr_form_data)->lst_error;
        extract($arr_form_data);

        if($dbh_adviser->check_uniqueness_for_editing($arr_form_data)->is_unique)
        {
            //Good, no duplicate in database
        }
        else
        {
            $message = "Record already exists with the same primary identifiers!";
        }

        if($message=="")
        {
            $dbh_adviser->edit($arr_form_data);


            redirect("listview_adviser.php?$query_string");
        }
    }
}
require 'subclasses/adviser_html.php';
$html = new adviser_html;
$html->draw_header('Edit Adviser', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);
$html->draw_hidden('Adv_Id');
$html->draw_hidden('orig_Org_Org_Id');
$html->draw_hidden('orig_Org_SAO_SAO_Id');
$html->draw_controls('edit');

$html->draw_footer();