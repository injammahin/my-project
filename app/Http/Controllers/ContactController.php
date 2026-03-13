<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display the contact form for the user
    public function showForm()
    {
        return view('contact'); // Show contact form view
    }

    // Store the submitted contact message
    public function storeMessage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        try {
            // Store the message in the database
            ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Redirect back with a success message
            return back()->with('success', 'Your message has been sent!');
        } catch (\Exception $e) {
            // Redirect back with an error message if something fails
            return back()->with('error', 'There was an error sending your message. Please try again.');
        }
    }

    // Admin view to see all messages
    public function adminMessages()
    {
        // Fetch all contact messages
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10); // Paginate results for better performance
        return view('admin.landing.contacts.index', compact('messages'));
    }

    // Admin view to delete a contact message
    public function destroy(ContactMessage $contactMessage)
    {
        // Delete the contact message
        $contactMessage->delete();

        // Redirect to the message index with a success message
        return redirect()->route('admin.landing.contacts.index')->with('success', 'Message deleted successfully!');
    }
}