<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function sample($no, $text) {
        $data = ['no' => $no, 'text' => $text];
        return view('sample')->with($data);
    }
}
