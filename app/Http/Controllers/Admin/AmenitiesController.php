<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AmenitiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    use Upload_image;
    public function index(AmenitiesDataTable $amenitiesDataTable){
        return $amenitiesDataTable->render('admin.amenities.index');
    }

    public function create(){
        return view('admin.amenities.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required','max:255'],
            'small_description'=>['required','max:500'],
            'image'=> ['required','image']
        ]);

         $image = $this->UploadImage($request,'image');
        $amenitie = new Amenities();
        $amenitie->title = $request->title;
        $amenitie->small_description = $request->small_description;
        $amenitie->image = $image;
        $amenitie->save();

        toastr('Data Saved Successfully' ,'success');
        return to_route('all_amenities');
    }

    public function destroy($id){
        $amenitie = Amenities::findOrFail($id);
        $this->remove_image($amenitie->image);
        $amenitie->delete();
        toastr('Data Saved Successfully' ,'success');
        return to_route('all_amenities');
    }
}
