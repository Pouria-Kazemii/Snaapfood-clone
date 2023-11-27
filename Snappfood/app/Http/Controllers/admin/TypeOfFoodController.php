<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeOfFoodsRequest;
use App\Models\TypeOfFood;
use Illuminate\Http\Request;

class TypeOfFoodController extends Controller
{
    public function index()
    {
        $types = TypeOfFood::all();

        return view('admin.food_types',[
            'types' => $types
        ]);
    }

    public function store(TypeOfFoodsRequest $request)
    {

        $validateData = $request->validated();

        TypeOfFood::create([
            'type' => $validateData['type']
        ]);

        return redirect()->route('admin.food_types');
    }

    public function delete(string $id)
    {
        TypeOfFood::find($id)->delete();

        return redirect()->route('admin.food_types');
    }

    public function update(TypeOfFoodsRequest $request,string $id)
    {

        $validateData = $request->validated();

        TypeOfFood::where('id',$id)->update([
            'type' => $validateData['type']
        ]);

        return redirect()->route('admin.food_types');
    }

}
