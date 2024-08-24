<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ApartmentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentUpdateRequest;
use App\Http\Requests\Admin\CreateApartemntRequest;
use App\Models\Apartment;
use App\Models\Hotel;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{

    use Upload_image ;
    /**
     * Display a listing of the resource.
     */
    public function index(ApartmentDataTable $apartmentDataTable)
    {
       return $apartmentDataTable->render('admin.apartment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
         return view('admin.apartment.create',compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateApartemntRequest $request)
    {
        $image = $this->UploadImage($request,'image');
        $apartment = new Apartment();
        $apartment->name = $request->name ;
        $apartment->image = $image ;
        $apartment->price = $request->price ;
        $apartment->max_persons = $request->max_persons ;
        $apartment->hotel_id = $request->hotel_id ;
        $apartment->size = $request->size;
        $apartment->view = $request->view;
        $apartment->num_beds = $request->num_beds ;
        $apartment->status = $request->status ;
        $apartment->save();
        toastr('Data Saved Successfully');
        return to_route('apartments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotels = Hotel::all();
        $apartment = Apartment::findOrFail($id);
        return view('admin.apartment.edit',compact('apartment','hotels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, string $id)
    {
        $image = $this->UploadImage($request,'image',$request->old_image);
        $apartment = Apartment::findOrFail($id);
        $apartment->name = $request->name ;
        $apartment->image = isset($image) ? $image : $request->old_image;
        $apartment->price = $request->price ;
        $apartment->max_persons = $request->max_persons ;
        $apartment->hotel_id = $request->hotel_id ;
        $apartment->size = $request->size;
        $apartment->view = $request->view;
        $apartment->num_beds = $request->num_beds ;
        $apartment->status = $request->status ;
        $apartment->save();
        toastr('Data Saved Successfully');
        return to_route('apartments.index');
    }

    public function delete_apartment($id){
        $apartment = Apartment::findOrFail($id);
        $this->remove_image($apartment->image);
        $apartment->delete();
        toastr('Data Saved Successfully');
        return to_route('apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->remove_image($apartment->image);
        $apartment->delete();
        toastr('Data Saved Successfully');
        return to_route('apartments.index');
    }
}
