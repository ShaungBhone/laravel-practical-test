<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFormRequest;
use App\Notifications\ContactSubmitted;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request)
    {
        $contact = Contact::create($request->validated());

        auth()
            ->user()
            ->notify(new ContactSubmitted($contact));

        return response()->json(
            [
                'success' => true,
                'data' => $contact,
            ],
            201,
        );
    }
}
