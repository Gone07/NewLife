<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(10);
        return ItemResource::collection($items);
    }

    public function getUserItems()
    {
        $user = Auth::user();

        if($user){
            $items = DB::table('items') -> where('user_id', $user->id) -> get();
            return new ItemResource($items);
        }
        else
        {
            return ItemResource::collection([]);
        }
    }
    public function getStoreItems($store_id)
    {

        $items = DB::table('items') -> where('store_id', $store_id) -> get();

        return new ItemResource($items);

    }


    public function store(ItemRequest $request)
    {
        $item = Item::create([
            'store_id' =>  $request->store_id,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'condition' => $request->condition,
            'weight' => $request->weight
        ]);

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $items = Item::findOrFail($id);
        return new ItemResource($items);
    }

    public function update(Request $request, $id)
    {
        $items = Item::findOrFail($id);
        $items->name = $request->name;
        $items->condition = $request->condition;
        $items->weight = $request->weight;
        if($items->save())
        {
            return new ItemResource($items);
        }
    }

    public function destroy($id)
    {
        $items = Item::findOrFail($id);
        if($items->delete())
        {
            return response()->json($items, 204);
        }
    }
}
