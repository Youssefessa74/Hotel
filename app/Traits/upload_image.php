<?php

namespace App\Traits;

use File;
use Illuminate\Http\Request;

trait Upload_image
{



    function UploadImage(Request $request, $inputName, $old_path = null, $path = '/uploads') {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            // Ensure the directory exists
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true, true);
            }

            try {
                $image->move(public_path($path), $imageName);
            } catch (\Exception $e) {
                \Log::error("File upload error: " . $e->getMessage());
                return back()->withErrors(['image' => 'File upload failed. Please try again.']);
            }

            // Delete previous file if exists
            if ($old_path && File::exists(public_path($old_path))) {
                File::delete(public_path($old_path));
            }

            return $path . '/' . $imageName;
        }

        return null;
    }


    public function remove_image(string $path){
        if($path && File::exists(public_path($path))){
          File::delete(public_path($path));
        }
    }
}
