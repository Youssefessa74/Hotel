<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WhatWeOfferDataTable;
use App\Http\Controllers\Controller;
use App\Models\Titles;
use App\Models\WhatWeOffer as ModelsWhatWeOffer;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class WhatWeOffer extends Controller
{
    use Upload_image;
    public function index(WhatWeOfferDataTable $whatWeOfferDataTable)
    {
        $keys = [
            'what_we_offer_title',
            'what_we_offer_first_description',
            'what_we_offer_second_description',
            'what_we_offer_image',
            'what_we_offer_image_old_image'
        ];
        $titles = Titles::whereIn('key', $keys)->get()->pluck('value', 'key');
        return $whatWeOfferDataTable->render('admin.what_we_offer.index', compact('titles'));
    }

    public function create()
    {
        return view('admin.what_we_offer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'image' => ['required', 'image'],
        ]);

        $image = $this->UploadImage($request, 'image');
        $offer = new ModelsWhatWeOffer();
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->image = $image;
        $offer->save();
        toastr('Data Saved Successfully');
        return to_route('offer_index');
    }

    public function destroy($id)
    {
        $offer = ModelsWhatWeOffer::findOrFail($id);
        $this->remove_image($offer->image);
        $offer->delete();
        toastr('Data Saved Successfully');
        return to_route('offer_index');
    }

    public function WhatWeOfferTitles(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'what_we_offer_title' => ['max:255'],
            'what_we_offer_first_description' => ['max:1000'],
            'what_we_offer_second_description' => ['max:1000'],
            'what_we_offer_image' => ['nullable', 'max:1000'], // Make image optional but validate if present
        ]);

        // Handle the image upload
        if ($request->hasFile('what_we_offer_image')) {
            $image = $this->UploadImage($request, 'what_we_offer_image');
        } else {
            $image = $request->input('what_we_offer_image_old_image');
        }

        // Update or create the key-value pairs in the Titles table
        foreach ($validatedData as $key => $value) {
            Titles::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Store the image path if it exists
        if ($image) {
            Titles::updateOrCreate(
                ['key' => 'what_we_offer_image'],
                ['value' => $image]
            );
        }

        toastr('Data Saved Successfully', 'success');
        return redirect()->route('offer_index');
    }
}
