<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use Upload_image ;
    public function index(ServiceDataTable $serviceDataTable){
        return $serviceDataTable->render('admin.service.index');
    }

    public function create(){
        return view('admin.service.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' =>['required','max:255'],
            'description'=>['required','max:1000'],
            'image_url'=>['required','image'],
        ]);
        $image = $this->UploadImage($request,'image_url');
        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->status = $request->status;
        $service->image_url = $image;
        $service->save();
        toastr('Data Saved Successfully');
        return to_route('service_index');
    }

    public function edit($id){
        $service = Service::findOrFail($id);
        return view('admin.service.edit',compact('service'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' =>['required','max:255'],
            'description'=>['required','max:1000'],
            'image_url'=>['image','nullable'],
        ]);
        $image = $this->UploadImage($request,'image_url',$request->old_image_url);
        $service =  Service::findOrFail($id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->status = $request->status;
        $service->image_url = isset($image) ? $image : $request->old_image_url;
        $service->save();
        toastr('Data Saved Successfully');
        return to_route('service_index');
    }
}
