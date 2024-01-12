<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use App\Rules\UpdateUniqueNameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('setting' , $restaurant);

        return view('restaurant.setting.home')->with(['restaurant' => $restaurant]);
    }

    public function updateStatus(string $name,)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('setting' , $restaurant);

        if ($restaurant->is_open == 'open'){
            $restaurant->update([
            'is_open' => 'close'
            ]);
        }else{
            $restaurant->update([
                'is_open' => 'open'
            ]);
        }

        return redirect()->back();

    }

    public function updateRestaurant(string $name , Request $request)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('setting' , $restaurant);

        if ($request->file('banner')){
            $oldBannerName=$restaurant->banner_image_path;
            Storage::disk('public')->delete('pictures/banners/'.$oldBannerName);

            $newBannerPath = \time() . '_' . $request->name . '.' . $request->file('banner')->extension();
            $request->file('banner')->move(storage_path('/app/public/pictures/banners/'), $newBannerPath);
        }


        if ($request->file('profile')){
            $oldProfileName=$restaurant->profile_image_path;
            Storage::disk('public')->delete('pictures/profile/'.$oldProfileName);

            $newProfilePath = \time() . '_' . $request->name . '.' . $request->file('profile')->extension();
            $request->file('profile')->move(storage_path('/app/public/pictures/profile/'), $newProfilePath);
        }


        $request->validate([
            'name' =>['required', new UpdateUniqueNameRule($restaurant->name)],
            'phone_number' => 'required',
            'address' => 'required',
            'account_number' => 'required',
            'sending_price' => 'required',
        ]);

        $restaurant->update([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'account_number' => $request->input('account_number'),
            'sending_price' => $request->input('sending_price'),
            'banner_image_path' => $newBannerPath ?? $restaurant->banner_image_path,
            'profile_image_path' => $newProfilePath ?? $restaurant->profile_image_path

        ]);

        return redirect()->back();
    }
}
