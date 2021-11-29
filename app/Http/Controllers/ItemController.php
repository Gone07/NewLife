<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'])->only(['destroy']);
    }


    public function index()
    {
        $items = Item::paginate(10);
        return ItemResource::collection($items);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $items = new Item();
        $items->name = $request->name;
        $items->price = $request->price;
        $items->weight = $request->weight;
        if($items->save())
        {
            return response()->json($items, 201);
        }
    }

    public function show($id)
    {
        $items = Item::findOrFail($id);
        return new ItemResource($items);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $items = Item::findOrFail($id);
        $items->name = $request->name;
        $items->price = $request->price;
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
