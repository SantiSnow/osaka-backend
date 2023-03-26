<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'country' => 'required|string',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Validation Error',
                'errors' => $validator->messages()
            ], 403);
        }

        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'country'=>$request->country,
            'message'=>$request->message,
        ]);

        $response = [
            'status' => "Contact saved successfully",
        ];

        return response($response, 201);
    }
}
