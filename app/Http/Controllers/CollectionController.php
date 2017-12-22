<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class CollectionController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * using slug get collection data
     * @param $slug
     * @param Request $request
     */

    public function getCollectionBySlug($slug, Request $request)
    {
        //Coding
        $collectionData = DB::table('COLLECTION')
            ->where('slug', $slug)
            ->where('isActive', true)
            ->first();
        //Response formate
        if (!isset($collectionData)) {
            return view('templates/new-collection/collection-detail')->with(["collection" => null]);
        }


        return view('templates/new-collection/collection-detail')->with(["collection" => $collectionData]);
    }

    /**
     * get all collection data which isactive=true
     * @return $this
     */
    public function getCollections()
    {
        //Coding
        $collectionsData = DB::table('COLLECTION')
            ->where('isActive', true)
            ->orderBy('sequence')
            ->get();

        //Response Set

        if (count($collectionsData) <= 0) {
            return view('templates/new-collection/collection')->with(["collections" => null]);
        }

        return view('templates/new-collection/collection')->with(["collections" => $collectionsData]);
    }

    /**
     * get collection data and return home page
     */
    public function homePage()
    {
        // Dynamic collection list
        $collectionsData = DB::table('COLLECTION')
            ->select('_id', 'bannerImage', 'headerImage', 'slug', 'title', 'sequence', 'isBanner')
            ->where('isActive', true)
            ->orderBy('sequence')
            ->get();
        //Response Set

        if (!count($collectionsData)) {
            return view('home')->with(["collections" => null]);
        }

        // Dynamic banner images
        $dynamicBanner = DB::table('DYNAMIC_IMAGE')
            ->where('type', DYNAMIC_IMAGE_WEB_BANNER)
            ->first();

        if (DEFAULT_HOME_PAGE_LOAD_WEB_MODULE_CODE != null) {
            $homePageWebModule = DB::table('WEB_MODULE')
                ->where('isActive', true)
                ->where('groupCode', DEFAULT_HOME_PAGE_LOAD_WEB_MODULE_CODE)
                ->orderBy('sequence')
                ->get();

            // Assign sub menu => If detail exists
            if ($homePageWebModule && count($homePageWebModule)) {

                foreach ($homePageWebModule as &$mainModule) {
                    $subModule = DB::table('WEB_MODULE')
                        ->where('isActive', true)
                        ->where('groupCode', $mainModule['code'])
                        ->orderBy('sequence')
                        ->first();
                    if (isset($subModule)) {
                        $mainModule['subMenu'] = $subModule;
                    }
                }
            }
        } else {
            $homePageWebModule = null;
        }

        return view('home')->with([
            "collections" => $collectionsData,
            "bannerImage" => $dynamicBanner,
            "homePageModules" => $homePageWebModule
        ]);
    }
}
