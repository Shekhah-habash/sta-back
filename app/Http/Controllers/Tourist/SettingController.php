<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    function countries(){
        return apiSuccess("قائمة الدول", DB::table('countries')->select("id as value" , "name as label")->get());
    }
    function provinces(){
        return apiSuccess("قائمة المحافظات", DB::table('provinces')->select("id as value" , "name as label")->get());
    }
}
