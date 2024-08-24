<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traits\Upload_image;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use Upload_image;
    public function index(TestimonialDataTable $testimonialDataTable){
        return $testimonialDataTable->render('admin.testimonial.index');
    }

    public function create(){
        return view('admin.testimonial.create');
    }

    public function store(Request $request){
        $request->validate([
            'full_name' => ['required','max:255'],
            'jop_title' => ['required','max:255'],
            'comment' => ['required','max:1000'],
            'image' => ['required','image']
        ]);
        $image = $this->UploadImage($request,'image');
        $testimonials =new Testimonial();
        $testimonials->full_name = $request->full_name;
        $testimonials->jop_title = $request->jop_title;
        $testimonials->comment = $request->comment;
        $testimonials->image = $image;
        $testimonials->status = $request->status ;
        $testimonials->save();
        toastr('Data Saved Successfully','success');
        return to_route('testimonials');
    }

    public function edit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit',compact('testimonial'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'full_name' => ['required','max:255'],
            'jop_title' => ['required','max:255'],
            'comment' => ['required','max:1000'],
            'image' => ['nullable','image']
        ]);
        $image = $this->UploadImage($request,'image',$request->old_image);
        $testimonials = Testimonial::findOrFail($id);
        $testimonials->full_name = $request->full_name;
        $testimonials->jop_title = $request->jop_title;
        $testimonials->comment = $request->comment;
        $testimonials->status = $request->status ;

        $testimonials->image = isset($image) ? $image : $request->old_image;
        $testimonials->save();
        toastr('Data Saved Successfully','success');
        return to_route('testimonials');
    }

    public function destroy($id){
        $testimonials = Testimonial::findOrFail($id);
        $this->remove_image($testimonials->image);
        $testimonials->delete();
        toastr('Data Saved Successfully','success');
        return to_route('testimonials');
    }
}
