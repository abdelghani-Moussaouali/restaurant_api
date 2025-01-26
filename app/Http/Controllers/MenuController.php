<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Http\Resources\RestItemsResource;
use App\Models\menu;
use App\Models\restItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
//  implements HasMiddleware
{


    // public static function middleware()
    // {
    //     return [
    //         new Middleware(
    //             'auth:sanctum',
    //             except: ['index',]
    //         )
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = menu::all();
        return  response()->json(
            [
                'menu' => MenuResource::collection($menu),
            ],
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $customers_id = $request->user()->customers->id;
        $item = restItem::where('customers_id', $customers_id)->find($id);
        $field = $request->validate([
            'item_menu' => 'string|min:3|required',
        ]);
        if (menu::where('item_menu', $request->item_menu)->where('rest_items_id',$item->id)->exists()) {
            return response()->json([
                'message' => 'you have already written this '
            ], 401);
        } else if (!$item) {
            return response()->json([
                'message' => 'write your own menu'
            ], 401);
        }

        $field['rest_items_id'] = $item->id;
        $item->menu()->create($field);
        return response()->json([
            'data' => new RestItemsResource($item),
        ]);


       
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        //
    }
}
