<?php


namespace App\Http\Controllers;


use Illuminate\Http\Response;

abstract class ApiController extends Controller
{
    protected function ok($body)
    {
        return response($body, Response::HTTP_OK);
    }
}
