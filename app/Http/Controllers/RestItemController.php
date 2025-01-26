<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResouece;
use App\Http\Resources\RestItemsResource;
use App\Http\Resources\UserResouece;
use App\Models\images;
use App\Models\restItem;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Response;
class RestItemController extends Controller
{
    // public static function middleware()
    // {
    //     return [
    //         new Middleware(
    //             'auth:sanctum',
    //             except: ['index', 'itemsCategory']
    //         )
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = restItem::inRandomOrder()->get();
        return  response()->json([
            'count' => $items->count(),
            'items' => RestItemsResource::collection($items)

        ]);
    }
    /**
     * Display a listing of category items
     */
    public function store(Request $request)
    {
        $restItems = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|string',
            'company_email' => 'required|email|unique:rest_items',
            'customers_id' => 'exists:customers,id',
            'phone_number' => 'required',
            'category' => 'required|in:cafeteria,resturant,desserts,pizza',
            'wilaya' => 'required|string',
            'address' => 'required',
        ]);
        $imagefield = $request->validate([
            'image_path' =>  'required|mimes:jpeg,jfif,png,jpg|max:2048',
        ]);


        // create a resturant  item
        $restItems['customers_id'] =  $request->user()->customers->id;
        $data = restItem::create($restItems);


        // get the new image path 
        $baseUrl = url('/');
        $imageName = str::random(10) . "." . $request->image_path->getClientOriginalExtension();
        $path = '/api/items/image/' . $imageName;
        Storage::disk('public')->put($imageName, file_get_contents($request->image_path));

        $imagefield['rest_items_id'] = $data->id;
        $imageCreate = images::create([
            'image_path' => $baseUrl . $path,
            'rest_items_id' => $data->id,
        ]);
        return response(
            [
                'data' => new RestItemsResource($data),
            ],

            200
        );
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $authUser = Auth::user();
        $user = User::find($id);
        if ($authUser->id != $user->id) {
            return response()->json([
                'message' => 'you dont have the acesss for this items',
            ]);
        }
        return response()->json([
            'user' => new UserResouece($user),
            'menu' => RestItemsResource::collection($user->items),
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = $request->user()->customers();
        $restItem = restItem::find($id);
        if ($restItem->customers_id != $user->id) {
            return Response()->json(
                [
                    'message' => 'not authorized'
                ],
                401
            );
        }
        $item = $request->validate(
            [
                'name' => 'max:255|string',
                'description' => 'string',
                'company_email' => 'string',
                'users_id' => 'integer',
                'phone_number' => 'string',
                'category' => 'string|in:cafe,rest,dess,pizza',
                'wilaya' => 'string',
                'address' => 'string',
            ]
        );
        $item['users_id'] = Auth::user();
        $restItem->update($item);
        return response()->json('the method update is sucessefully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        restItem::find($id)->forceDelete();
        return response()->json('the method delete is sucessefully');
    }





    public function itemsCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|in:cafeteria,resturant,desserts,pizza',

        ]);
        $items = restItem::where('category', $request->category)->inRandomOrder()->get();
        return response()->json([
            'count' => $items->count(),
            'items' => RestItemsResource::collection($items),

        ]);
    }



    public function show_image($filename){
        
        
            $path = public_path('storage/' . $filename);
    
            if (!file_exists($path)) {
                return response()->json([
                    'data' => $path,
                    'error' => 'Image not found'
                ], 404);
            }
    
            $file = file_get_contents($path);
            $type = mime_content_type($path);
    
            return Response::make(
                $file,
                200,
                [
                    'Content-Type' => $type,
                    'Content-Disposition' => 'inline; filename="' . $filename . '"'
                ]
    
            );
            
        
    }
}
