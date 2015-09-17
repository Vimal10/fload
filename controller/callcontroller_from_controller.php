<?php

function callController()
{
    $args = func_get_args();

    $callable = explode('@', $args[0]);

    unset($args[0]);
    if (isset($args[1]))
    {
        //with args
        $controller = new $callable[0]();
        return $controller->$callable[1](implode(',', $args));
    }

    return $controller->$callable[1]();
}

$sidebar = callController('VimalController@hello', 'hsdfahsdfj');
echo $sidebar;
