<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'])->only(['destroy', 'store', 'update']);
    }


    public function index()
    {
        $stores = Store::paginate(10);
        return StoreResource::collection($stores);
    }
    public function indexAll()
    {
        $stores = Store::all();
        return StoreResource::collection($stores);
    }


    public function store(StoreRequest $request)
    {
        $store = new Store();
        $store->name = $request->name;
        $store->address = $request->address;
        $store->city = $request->city;
        $store->numberOfItems = $request->numberOfItems;
        if($store->save())
        {
            return response()->json($store, 201);
        }
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);
        return new StoreResource($store);
    }

    public function update(StoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->city = $request->city;
        $store->numberOfItems = $request->numberOfItems;
        if($store->save())
        {
            return new StoreResource($store);
        }
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        if($store->delete())
        {
            return response()->json($store, 204);
        }
    }
}
