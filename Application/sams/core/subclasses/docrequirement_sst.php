<?php
require_once 'sst_class.php';
require_once 'docrequirement_dd.php';
class docrequirement_sst extends sst
{
    function __construct()
    {
        $this->fields        = docrequirement_dd::load_dictionary();
        $this->relations     = docrequirement_dd::load_relationships();
        $this->subclasses    = docrequirement_dd::load_subclass_info();
        $this->table_name    = docrequirement_dd::$table_name;
        $this->readable_name = docrequirement_dd::$readable_name;
        parent::__construct();
    }
}
