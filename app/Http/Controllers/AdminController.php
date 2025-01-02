<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactResponseMail;

class AdminController extends Controller
{
    public function getUserManagement()
    {
        $users = User::leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.id', 'users.email', 'users.blacklisted','users.is_admin', 'profiles.username') // Select the username from the profiles table
        ->get();
        return view('admin.userManagement',compact('users'));
    }

    public function blacklistUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->blacklisted = !$user->blacklisted;
        $user->save();
        return redirect()->route('admin.userManagement')
                        ->with('status', 'User blacklisted status updated successfully!');
    }
    public function adminUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_admin = !$user->is_admin;
        $user->save();
        return redirect()->route('admin.userManagement')
                        ->with('status', 'User admin status updated successfully!');
    }
    public function makeNewUser()
    {
        return view('admin.makeUser');
    }
    public function storeUser(Request $request)
    {
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'username' => 'required|unique:profiles,username',
            'birthday' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'bio' => 'nullable|string|max:255',
            'is_admin' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        Log::info('Passed validation');

        try {
            DB::transaction(function () use ($request) {
                // Create the user
                $user = new User();
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->is_admin = $request->input('is_admin') ?? false;
                $user->save();
        
                // Create the profile through the user's relationship
                $profileData = [
                    'username' => $request->input('username'),
                    'birthday' => $request->input('birthday'),
                    'about_me' => $request->input('bio'),
                ];
        
                // Handle profile picture if provided
                if ($request->hasFile('profile_picture')) {
                    $file = $request->file('profile_picture');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('images', $filename, 'public');
                    $profileData['pfp'] = $filename;
                }
        
                $user->profile()->create($profileData); // Create profile via association
            });
        
            return redirect()->route('admin.userManagement')
                            ->with('status', 'User and profile created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user or profile: ' . $e->getMessage());
            return redirect()->back()
                            ->withErrors(['error' => 'An error occurred while creating the user.'])
                            ->withInput();
        }
    }
    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('admin.userManagement')
                        ->with('status', 'User deleted successfully!');
    }        
    public function showContactDashboard()
    {
        $unresolvedRequests = ContactRequest::where('is_resolved', false)->orderBy('created_at', 'desc')->get();
        $resolvedRequests = ContactRequest::where('is_resolved', true)->orderBy('resolved_at', 'desc')->get();
        return view('admin.contactDashboard',compact('unresolvedRequests', 'resolvedRequests')); 
    }
    public function respondContactRequest(Request $request, $id)
    {
        Log::info($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'response' => 'required|string',
        ]);
        $contactRequest = ContactRequest::findOrFail($id);
        if (!$contactRequest) {
            return redirect()->back()->with('error', 'Contact request not found.');
        }
        $contactRequest->is_resolved = true;
        $contactRequest->response = $validated['response'];
        $contactRequest->response_by = auth()->user()->profile->username; // Assuming the admin is logged in
        $contactRequest->resolved_at = now();
        $contactRequest->save();
        Mail::to($contactRequest->email)->send(new ContactResponseMail($validated['response'],$validated['subject'],$validated['name']));

        return redirect()->route('admin.contactDashboard')->with('success', 'Response sent successfully.');
    }
    public function deleteContactRequest($id)
    {
        $contactRequest = ContactRequest::findOrFail($id);
        if (!$contactRequest) {
            return redirect()->back()->with('error', 'Contact request not found.');
        }
        $contactRequest->delete();
        return redirect()->route('admin.contactDashboard')->with('success', 'Contact request deleted successfully.');
    }
}
