<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Titles;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $keys = ['contact_button_title', 'contact_description', 'contact_title'];
        $titles = Titles::whereIn('key', $keys)->get()->pluck('value', 'key');
        $contact = Contact::firstOrFail();
        return view('admin.contact.index',compact('contact','titles'));
    }

    public function store(Request $request){

      //  dd($request->all());
       $request->validate([
            'address' => ['required','max:255'],
            'phone' => ['required','max:100'],
            'email' => ['required','email'],
            'website' => ['required'],
        ]);

        Contact::updateOrCreate(['id'=>1],
        [
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        toastr('Data Saved Successfully');
        return redirect()->back();
    }

    public function contact_titles(Request $request){
        $validatedData = $request->validate([
            'contact_title'=>['max:100'],
            'contact_description'=>['max:500'],
            'contact_button_title' => ['max:100'],
        ]);
         // Update or create each key-value pair
         foreach($validatedData as $key => $value){
            Titles::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        toastr('Data Saved Successfully');
        return redirect()->back();
    }
}
