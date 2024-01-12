<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFoodRequest;
use App\Http\Requests\EditFoodRequest;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\TypeOfFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FoodController extends Controller
{

    public function index(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $foods = Food::where('restaurant_id' , $restaurant->id)->where('is_deleted',false)->get();
        $typeOfFoods = TypeOfFood::all();


         return view('restaurant.food.foods',[
             'foods' => $foods,
             'restaurant' => $restaurant,
             'typeOfFoods' => $typeOfFoods
         ]);
    }

    public function create(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $typeOfFoods = TypeOfFood::all();

        $this->authorize('foodCreate' , $restaurant);

        return view('restaurant..food.food_create',[
            'restaurant' => $restaurant,
            'typeOfFoods' => $typeOfFoods
        ]);
    }

    public function store(CreateFoodRequest $request , string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('foodCreate' , $restaurant);


        $validatedData = $request->validated();
        if (!$request->input('image')){
            $newImagePath ='home_background.jpg' ;
        }else{
        $newImagePath = \time() . '_' . $request->name . '.' . $request->image->extension();
            $request->image->move(storage_path('/app/public/pictures/foods/'), $newImagePath);
        }


        Food::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'raw_material' => $validatedData['raw_material'],
            'image_path' => $newImagePath,
            'type_of_food_id' => TypeOfFood::where('type',$validatedData['type_of_food'])->first()->id,
            'restaurant_id' => $restaurant->id,
            'is_deleted' => false
        ]);

        return redirect("/restaurant/$restaurant->name/foods")->with(['restaurant' => $restaurant]);
    }

    public function show(string $name , string $id)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $food = Food::find($id);


        return view('restaurant.food.food_show' , [
            'restaurant' => $restaurant,
            'food' => $food,
        ]);
    }

    public function edit( string $name , string $id)
    {
        $typeOfFoods = TypeOfFood::all();
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('foodUpdate' , $restaurant);

        $food = Food::find($id);
        return view('restaurant.food.food_edit' , [
            'restaurant' => $restaurant,
            'food' => $food,
            'typeOfFoods' => $typeOfFoods
        ]);
    }

    public function update(EditFoodRequest $request, string $name,string $id)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $validatedData = $request->validated();

        $this->authorize('foodUpdate' , $restaurant);

        if ($request->image){
            $oldImageName=Food::where('id',$id)->first()->image_path;
            Storage::disk('public')->delete('pictures/foods/'.$oldImageName);

            $newImagePath = \time() . '_' . $request->name . '.' . $request->image->extension();
            $request->image->move(storage_path('/app/public/pictures/foods/'), $newImagePath);
        }


        Food::where('id' , $id)->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'raw_material' => $validatedData['raw_material'],
            'image_path' => $newImagePath ?? Food::where('id',$id)->first()->image_path,
            'type_of_food_id' => TypeOfFood::where('type',$validatedData['type_of_food'])->first()->id,
            'restaurant_id' => $restaurant->id,
            'is_deleted' => false
        ]);

        return redirect("/restaurant/$restaurant->name/foods")->with(['restaurant' => $restaurant]);
    }

    public function destroy(string $name,string $id)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('foodDelete' , $restaurant);

        Food::find($id)->update([
            'is_deleted' => true
        ]);
        return redirect("/restaurant/$restaurant->name/foods")->with(['restaurant' => $restaurant]);
    }

    public function search(Request $request,string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $value = $request->input('search');
        $type = TypeOfFood::where('type',$request->input('type_of_food'))->first();


        $foods = Food::where('restaurant_id' , $restaurant->id)
            ->where('name','LIKE' , "%$value%")
            ->where('is_deleted' , false)
            ->where('type_of_food_id' , $type->id)
            ->
            get();

        return view('restaurant.food.search', [
            'restaurant' => $restaurant,
            'foods' => $foods
        ]);
    }
}
