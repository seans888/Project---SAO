<?php
require_once 'calendar_event_dd.php';
class calendar_event_html extends html
{
    function __construct()
    {
        $this->fields        = calendar_event_dd::load_dictionary();
        $this->relations     = calendar_event_dd::load_relationships();
        $this->subclasses    = calendar_event_dd::load_subclass_info();
        $this->table_name    = calendar_event_dd::$table_name;
        $this->readable_name = calendar_event_dd::$readable_name;
    }
}
