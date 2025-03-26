<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class User2Controller extends Controller
{
    use ApiResponser;

    private $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.site2.base_url');
    }

    public function index()
    {
        // Clear all the codes inside the Controller Methods/Functions
    }

    public function add(Request $request)
    {
        // Clear all the codes inside the Controller Methods/Functions
    }

    public function show($id)
    {
        // Clear all the codes inside the Controller Methods/Functions
    }

    public function update(Request $request, $id)
    {
        // Clear all the codes inside the Controller Methods/Functions
    }

    public function delete($id)
    {
        // Clear all the codes inside the Controller Methods/Functions
    }
}