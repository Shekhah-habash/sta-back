<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function countries(){
        return apiSuccess("countries list", Country::select("id as value" , "name as label")->get());
    }
}
