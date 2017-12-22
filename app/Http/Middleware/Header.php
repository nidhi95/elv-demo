<?php
/**
 * Created by PhpStorm.
 * User: nidhidesai
 * Date: 22/11/17
 * Time: 11:23 AM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use View;

class Header
{
    public function handle($request, Closure $next)
    {

        // Get web content modules
        $webModules = DB::table('WEB_MODULE')
            ->where('isActive', true)
            ->orderBy('sequence')
            ->get();

        $webModulesForMenu = [];
        $groupByType = [];
        if (isset($webModules) && count($webModules)) {
            array_walk($webModules, function ($v, $k) use (&$groupByType) {
                if (isset($v['viewType']))
                    $groupByType[$v['viewType']][] = $v;
            });
            $mainMenuModules = $groupByType[WEB_MODULE_VIEW_AS_MAIN_MENU];
            $subMenuModules = $groupByType[WEB_MODULE_VIEW_AS_SUB_MENU];

            // assign sub menu to it's main menu
            foreach ($mainMenuModules as &$mainModule) {
                $mainModule['subMenus'] = array();
                foreach ($subMenuModules as $subMenu) {
                    if (isset($mainModule['code']) && isset($subMenu['groupCode']) &&
                        $mainModule['code'] == $subMenu['groupCode']) {
                        array_push($mainModule['subMenus'], $subMenu);
                    }
                }
            }
            View::share('webModules', $mainMenuModules);
        }
        return $next($request);
    }
}