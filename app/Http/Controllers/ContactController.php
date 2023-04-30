<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Notifications\ContactSubmitted;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'dob' => 'nullable|date',
            'phone' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                400,
            );
        }

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->dob = $request->input('dob');
        $contact->phone = $request->input('phone');
        auth()
            ->user()
            ->notify(new ContactSubmitted($contact));
        $contact->save();

        return response()->json(
            [
                'success' => true,
                'data' => $contact,
            ],
            201,
        );
    }
}
