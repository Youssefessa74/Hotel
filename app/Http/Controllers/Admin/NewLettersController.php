<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\NewsLettersMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewLettersController extends Controller
{
    public function index(SubscriberDataTable $subscriberDataTable){
        return $subscriberDataTable->render('admin.subscribe.index');
    }

    public function SendNewsLetters(Request $request){
        $request->validate([
            'subject' => ['required','max:255'],
            'message' => ['required','max:1000']
        ]);
        $subscribers = Subscriber::pluck('email')->toArray();
        Mail::to($subscribers)->send(new NewsLettersMail($request->subject,$request->message));
        toastr('News Letters Sent Successfully');
        return redirect()->back();
    }

    public function destroy($id){
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        toastr('Subscriber Deleted Successfully');
        return redirect()->back();
    }
}
