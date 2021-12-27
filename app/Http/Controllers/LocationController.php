<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adrianorosa\GeoLocation\GeoLocation;

class LocationController extends Controller
{
    public function index(Request $request)
    {

        $ipAddress = $request->ip();
        $static = '197.30.131.167';
        $location = GeoLocation::lookup($static,$responseFilter = 'geo');

        return json_encode($location);
    }
}
