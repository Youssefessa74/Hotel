<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HotelDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateHotelRequest;
use App\Models\Hotel;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    use Upload_image ;
    public function index(HotelDataTable $hotelDataTable)
    {
        return $hotelDataTable->render('admin.hotel.index');
    }

    public function create(){
        return view('admin.hotel.create');
    }

    public function store(CreateHotelRequest $request){
        $image = $this->UploadImage($request,'image');
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->location = $request->location;
        $hotel->image = $image;
        $hotel->description = $request->description;
        $hotel->save();
        toastr('Data Saved Successfully') ;
        return to_route('all_hotels');

    }

    public function edit($id) {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.edit',compact('hotel'));
    }

    public function update($id ,Request $request){
          $request->validate([
            'name' => ['required','max:255'],
            'image' => ['image'],
            'description' => ['required','max:1000'],
            'location' => ['required','max:255']
          ]);
        $image = $this->UploadImage($request,'image',$request->old_image);
        $hotel = Hotel::findOrFail($id);
        $hotel->name = $request->name;
        $hotel->location = $request->location;
        $hotel->image = isset($image) ? $image : $request->old_image;
        $hotel->description = $request->description;
        $hotel->save();

         toastr('Data Saved Successfully') ;
        return to_route('all_hotels');
    }

    public function destory($id){
        $hotel = Hotel::findOrFail($id);
      $this->remove_image($hotel->image);
      $hotel->delete();
      toastr('Data Saved Successfully') ;
      return to_route('all_hotels');
    }

}
