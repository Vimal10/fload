
<?php
//http://stackoverflow.com/questions/12085619/php-rest-put-delete-options

if( $method === 'post' && isset($_REQUEST['REQUEST_METHOD'])) {
    $tmp = strtolower((string)$_REQUEST['REQUEST_METHOD']);
    if( in_array( $tmp, array( 'put', 'delete', 'head', 'options' ))) {
        $method = $tmp;
    }
    unset($tmp);
}

// now, just run the logic that's appropriate for the requested method
switch( $method ) {
    case "get":
        // logic for GET here
        break;

    case "put":
        // logic for PUT here
        break;        

    case "post":
        // logic for POST here
        break;

    case "delete":
        // logic for DELETE here
        break;

    case "head":
        // logic for DELETE here
        break;

    case "options":
        // logic for DELETE here
        break;

    default:
        header('HTTP/1.0 501 Not Implemented');
        die();
}
