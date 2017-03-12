<?php

function smarty_modifier_Domains($key) {
    return call_user_func_array(array('Domains', 'get'), func_get_args());
}
