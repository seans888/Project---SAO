<?php
require 'subclasses/organization_sst.php';
$sst = new organization_sst;
$sst->auto_test('detail_view');
$sst_script = $sst->script;