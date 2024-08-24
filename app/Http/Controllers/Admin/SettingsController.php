<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $keys = ['paypal_client_id','paypal_currency'];
        // Retrieve the PayPal client ID setting
        $settings = Setting::whereIn('key', $keys)->get()->pluck('value', 'key');
        return view('admin.settings.index',compact('settings'));
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'paypal_client_id' => 'required|string',
            'paypal_currency' => ['required'],
        ]);
         // Update or create each key-value pair
         foreach($validatedData as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        toastr('Data Saved Successfully','success');
        return redirect()->route('settings');
    }
}
