<?php

namespace Foostart\Sample;

use App\Http\Controllers\Controller;

class SampleController extends Controller
{

    public function index()
    {
        return view('sample::index');
    }

}