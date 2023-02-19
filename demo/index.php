<?php

// Start this micro API server with `php -S 0.0.0.0:1234` so you can test things.

require_once '../app/vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

switch ($request->get('route', 'get')) {
    case 'post':
        error_log(print_r([$request, $request->getContent()], true));
        (new Response('Received'))->send();
        break;

    default:
        (new JsonResponse([
            [
                'index' => 1,
                'data' => 'some data linked to 1',
            ],[
                'index' => 2,
                'data' => 'some data related to two',
            ],[
                'index' => 3,
                'data' => 'some data third data',
            ],[
                'index' => 4,
                'data' => 'some data other 4',
            ],[
                'index' => 5,
                'data' => 'five some data',
            ],[
                'index' => 10,
                'data' => 'some data tens of',
            ],
        ]))->send();
}

exit;
