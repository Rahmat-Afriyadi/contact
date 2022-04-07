<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NontificationContact;

class ContactController extends Controller
{
    //
    public function input(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error', 'message'=>$validator->errors()]);
        }
        $input = $request->all();
        Mail::to('rada.digital404@gmail.com')->send(new NontificationContact($input));
        return response()->json(['status'=>'berhasil', 'data'=>$request->all()]);
        // return view('nontification', ['data'=>$input]);
    }

    public function test()
    {
        return 'test aja';
    }
}
