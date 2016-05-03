
<?php

//http://stackoverflow.com/questions/8336308/how-to-do-a-php-hook-system

function event($event, $value = NULL, $callback = NULL)
{
    static $events;

    // Adding or removing a callback?
    if ($callback !== NULL)
    {
        if ($callback)
        {
            $events[$event][] = $callback;
        }
        else
        {
            unset($events[$event]);
        }
    }
    elseif (isset($events[$event])) // Fire a callback
    {
        foreach ($events[$event] as $function)
        {
            $value = call_user_func($function, $value);
        }
        return $value;
    }
}

event('filter_text', NULL, function($text) {
    return htmlspecialchars($text);
});
// add more as needed
event('filter_text', NULL, function($text) {
    return nl2br($text);
});



$text = event('filter_text', "<html>\n");


echo $text;
//register_plugin("hook_type", "plugin_function_123");
//
//function plugin_function_123($params) { ... }
//Where the hook_type is often an action name or something. And when the main application runs through a specific point (or e.g. needs some data processsed) it invokes all registered callback functions:
//
//$output = call_plugins("hook_type", $param1, $param2);
//This is often implemented behind the scenes as a simple loop:
//
//foreach ($registered_plugins[$action] as $func) {
//    $func($param1, $param2, ...);   // or call_user_func_
//}
