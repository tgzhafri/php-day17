<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Traits\JsonTrait;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // protected function jsonResponse($data, $message = '', $code = 200)
    // {
    //     // 
    //     return response()->json([
    //         'status' => ($code != 200) ? false : true,
    //         'code' => $code,
    //         'data' => $data,
    //         'message' => $message
    //     ], $code);
    // }
}
