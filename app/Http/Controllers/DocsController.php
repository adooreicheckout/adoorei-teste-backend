<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocsController extends Controller
{
    public function index()
    {
        return redirect('/docs/index.html');
    }
}
