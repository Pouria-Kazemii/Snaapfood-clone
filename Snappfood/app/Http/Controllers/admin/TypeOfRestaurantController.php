<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeOfRestaurantRequest;
use App\Models\TypeOfRestaurant;

class TypeOfRestaurantController extends Controller
{
    public function index()
    {
        $types = TypeOfRestaurant::all();

        return view('admin.restaurant_types',[
            'types' => $types
        ]);
    }

    public function store(TypeOfRestaurantRequest $request)
    {

        $validateData = $request->validated();

        TypeOfRestaurant::create([
            'type' => $validateData['type']
        ]);

        return redirect()->route('admin.restaurant_types');
    }

    public function delete(string $id)
    {
        TypeOfRestaurant::find($id)->delete();

        return redirect()->route('admin.restaurant_types');
    }

    public function update(TypeOfRestaurantRequest $request,string $id)
    {

        $validateData = $request->validated();

        TypeOfRestaurant::where('id', $id)->update([
            'type' => $validateData['type']
        ]);

        return redirect()->route('admin.restaurant_types');
    }
}
