<?php

class Domains {

    static protected $settings;

    function __construct() {
        
        if (!isset($domain)) {
            $domain = 'olero';
        }

        self::$settings = json_decode(file_get_contents(dirname(__FILE__) . '/../domains/' . $domain));
    }

    static function get($path) {
        $ret = self::$settings->$path;
        $args = func_get_args();

        for($i=1;$i<func_num_args();$i++) {
            $ret = is_array($ret)?$ret[func_get_arg($i)]:$ret->{func_get_arg($i)};
        }
        
        return $ret;
    }

    static function key($path, $key) {

        $path = func_get_args();
        $key = array_pop($path);

        $arr = call_user_func_array(array('self', 'get'), $path);

        foreach ($arr as $item) {
            if ($item->key == $key) {
                return $item;
            }
        }

        return null;
    }

    static function role($path, $role) {

        $path = func_get_args();
        $role = array_pop($path);

        $arr = call_user_func_array(array('self', 'get'), $path);

        foreach ($arr as $item) {
            if (isset($item->role) && $item->role == $role) {
                return $item;
            }
        }

        return null;
    }

    static function parse($fields, $input, $output) {

        foreach ($fields as $f) {
            if (!isset($input[$f->name])) {
               
                if ($f->type == "checkbox") {
                    $output->{$f->name} = 0;
                } 
                continue;
            }
            if ($f->type == "time") {
                $output->{$f->name} = (
                        $input[$f->name][0] * 3600 +
                        $input[$f->name][1] * 60 +
                        $input[$f->name][2]
                        );
            } elseif ($f->type == "checkbox") {
                $value = 0;
                foreach ($input[$f->name] as $key => $val) {
                    if ($val) {
                        $value += pow(2, $key);
                    }
                }
                $output->{$f->name} = $value;
            } else {
                $output->{$f->name} = $input[$f->name];
            }
        }
    }

    static function parsepart($input, $output = null) {
        $output = ($output === null) ? new stdClass() : $output;
        self::parse(self::get('parts', $input['type'], 'fields'), $input, $output);
        $output->type = $input['type'];
        return $output;
    }

    static function parseworkout($input, $output = null) {
        $output = ($output === null) ? new stdClass() : $output;
        self::parse(self::get('workout'), $input, $output);
        return $output;
    }

    static function parseresult($input, $output = null) {
        $output = ($output === null) ? new stdClass() : $output;
        self::parse(self::get('result'), $input, $output);
        return $output;
    }

    /* IF THIS FUNCTION IS STILL HERE YEAR 2012 I'M GETTING PISSED */

    static function parsefields($input, $output = null) {
        $output = ($output === null) ? new stdClass() : $output;
        self::parseworkout($input, $output);
        self::parseresult($input, $output);
        return $output;
    }

}
