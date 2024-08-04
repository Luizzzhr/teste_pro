<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
        public function show(Request $request)
    {
        return Inertia::render('Test', [
                'test' => 'test',
            ]);
    }
}
