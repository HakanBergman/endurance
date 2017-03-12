<?php

class Part_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function toString($part) {
        
        if(Domains::get('parts', $part->type, "tostring", 0) == "value") {
            return Domains::get('parts', $part->type, "tostring", 1);
        }
        
        foreach(Domains::get('parts', $part->type, "fields") as $f) {
            if($f->name == Domains::get('parts', $part->type, "tostring", 1)) {
                foreach($f->values as $v) {
                    if($v->key == $part->{$f->name}) { return $v->val; }
                }
            }
        }
        
        return "";
    }
    
}

/* End of file */