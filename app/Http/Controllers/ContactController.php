<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactRequestMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }
    public function submit(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        ContactRequest::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $contactDetails = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];
        Log::info('Contact request from ' . $contactDetails['firstname'] . ' ' . $contactDetails['lastname'] . ' with email ' . $contactDetails['email'] . ' and message: ' . $contactDetails['message']);
        Mail::to('jessy.gencel@student.ehb.be')->send(new ContactRequestMail($contactDetails));
        return redirect()->route('contact.show')->with('success', 'Your message has been sent successfully.');
    }
}
