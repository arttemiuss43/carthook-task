<?php


namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class ApiController extends Controller
{
    /**
     * Return successful json response.
     *
     * @param $body
     * @return JsonResponse
     */
    protected function ok($body)
    {
        return response()->json($body, Response::HTTP_OK);
    }
}
