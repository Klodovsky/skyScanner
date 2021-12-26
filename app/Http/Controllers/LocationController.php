<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adrianorosa\GeoLocation\GeoLocation;

class LocationController extends Controller
{
    public function index(Request $request)
    {

        $ipAddress = $request->ip();
        $location = GeoLocation::lookup($ipAddress,$responseFilter = 'geo');

        return json_encode($location);


    }
}
