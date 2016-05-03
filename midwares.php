<?php

//use Closure;

function dump($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

class Request {

    function condition()
    {
        return true;
    }

}

class Response {
//    $Db::prepare('time=now()');
}

class Session {

    function handle(Request $req, Response $res, Closure $next)
    {
        if (!$req->condition())
        {
            echo 'stop from session';
            return;
        }

        return $next();
    }

}

class Auth {

    function handle(Request $req, Response $res, Closure $next)
    {
        return $next();
    }

}

$midwares = [
        Session::class,
        Auth::class
];


$webMidWares = [
        'hello' => Session::class
];

foreach ($webMidWares as $k => $v)
{
    echo $k . ' : ' . $v;
}

function runMidWare($class)
{

    $inc = new $class;
    return $inc->handle(new Request, new Response, function() {
            return true;
        });

    return FALSE;
}

//while(runMidWare($index, $midwares))
//$index = 0;
foreach ($midwares as $key => $class)
{
    $done = runMidWare($class);
    if ($done == FALSE)
    {
        echo 'stop';
        exit();
    }
}

class Application {

    public function __construct($config)
    {
        
    }

}

$app->bind('CLASS', function() {
    
});
$app->singletone('CLASS', function() {
    
});
$app->instance('CLASS', function() {
    
});

$fooBar = $this->app->make('FooBar');
//Secondly, you may access the container like an array, since it implements PHP's ArrayAccess interface:

$fooBar = $this->app['FooBar'];
//arrayaccess
$this->app->resolving(function ($object, $app) {
    // Called when container resolves object of any type...
});
?>


-- Application class

-- Container
-- Invoker
-- Midwares
-- Routes 
-- Controllers
-- Models 
-- Views


-- Libs
-- Request
-- Response
-- Validation
-- Sessions
-- Cookies
-- 




--## Security

--handle url and encode 
--csrf
--xss
https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet

https://github.com/BKcore/NoCSRF/tree/master/example
