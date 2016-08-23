<?php
//****************************************************************************************
//Generated by Cobalt, a rapid application development framework. http://cobalt.jvroig.com
//Cobalt developed by JV Roig (jvroig@jvroig.com)
//****************************************************************************************
require 'path.php';
init_cobalt('Delete sao');

if(isset($_GET['SAO_Id']))
{
    $SAO_Id = urldecode($_GET['SAO_Id']);
    require_once 'form_data_sao.php';
}

if(xsrf_guard())
{
    init_var($_POST['btn_cancel']);
    init_var($_POST['btn_delete']);
    require 'components/query_string_standard.php';

    if($_POST['btn_cancel'])
    {
        log_action('Pressed cancel button');
        redirect("listview_sao.php?$query_string");
    }

    elseif($_POST['btn_delete'])
    {
        log_action('Pressed delete button');
        require_once 'subclasses/sao.php';
        $dbh_sao = new sao;

        $object_name = 'dbh_sao';
        require 'components/create_form_data.php';

        $dbh_sao->delete($arr_form_data);


        redirect("listview_sao.php?$query_string");
    }
}
require 'subclasses/sao_html.php';
$html = new sao_html;
$html->draw_header('Delete Sao', $message, $message_type);
$html->draw_listview_referrer_info($filter_field_used, $filter_used, $page_from, $filter_sort_asc, $filter_sort_desc);

$html->draw_hidden('SAO_Id');

$html->detail_view = TRUE;
$html->draw_controls('delete');

$html->draw_footer();