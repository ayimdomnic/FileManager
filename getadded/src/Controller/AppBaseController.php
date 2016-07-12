<?php

namespace Ayim\Generator\Controller;

use App\Http\Controllers\Controller as Controller;
use Ayim\Generator\Utils\ResponseUtil;
use Response;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }
}
