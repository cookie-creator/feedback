<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    function __construct()
    {

    }

    public function index(Request $request)
    {
        dd('Client page');
    }
}
