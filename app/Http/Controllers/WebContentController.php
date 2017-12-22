<?php
/**
 * Created by PhpStorm.
 * User: nidhidesai
 * Date: 22/11/17
 * Time: 2:21 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class WebContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * using slug get collection data
     * @param $slug
     * @param Request $request
     */

    public function getContentByCode($code, Request $request)
    {
        // Get web module id from codfe
        $contentModuleData = DB::table('WEB_MODULE')
            ->where('code', $code)
            ->where('isActive', true)
            ->first();
        //Response formate
        if (!isset($contentModuleData)) {
            return view('templates/web-content/content-detail')->with(["contentDetail" => null]);
        } else {
            $contentData = DB::table('WEB_MODULE_CONTENT')
                ->where('webModuleId', $contentModuleData['_id'])
                ->orderBy('sequence')
                ->get();

            $contentModuleData['contents'] = $contentData;
            return view('templates/web-content/content-detail')->with(["contentDetail" => $contentModuleData]);
        }
    }
}