<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Base\Company;
use App\Models\Prefecture;

class ApiCompanyController extends Controller
{
    public function getCompanyTabular()
    {
        $company = Company::orderBy('id', 'desc')->with('prefecture')->get();
        return response()->json($company);
    }

    public function getPrefectureTabular()
    {
        $prefecture = Prefecture::all();
        return response()->json($prefecture);
    }
}
