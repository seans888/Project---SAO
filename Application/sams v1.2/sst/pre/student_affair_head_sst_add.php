<?php
require 'subclasses/student_affair_head_sst.php';
$sst = new student_affair_head_sst;
$sst->auto_test();
$sst_script = $sst->script;