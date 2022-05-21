<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    function __construct()
    {

    }

    public function index(Request $request)
    {
        dd('Maneger page');
    }
}
