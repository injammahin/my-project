@extends('layouts.admin')

@section('title', 'View Contact Message')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-4xl font-extrabold mb-6 text-gray-900">View Contact Message</h1>

        <!-- Message Details Card -->
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-4xl mx-auto">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Message Details</h2>
            <div class="space-y-4 text-gray-700">

                <!-- Name -->
                <div class="flex items-center space-x-4">
                    <strong class="text-xl font-medium text-gray-800">Name:</strong>
                    <span class="text-lg">{{ $contact->name }}</span>
                </div>

                <!-- Email -->
                <div class="flex items-center space-x-4">
                    <strong class="text-xl font-medium text-gray-800">Email:</strong>
                    <span class="text-lg">{{ $contact->email }}</span>
                </div>

                <!-- Subject -->
                <div class="flex items-center space-x-4">
                    <strong class="text-xl font-medium text-gray-800">Subject:</strong>
                    <span class="text-lg">{{ $contact->subject }}</span>
                </div>

                <!-- Message -->
                <div class="flex items-start space-x-4">
                    <strong class="text-xl font-medium text-gray-800">Message:</strong>
                    <p class="text-lg">{{ $contact->message }}</p>
                </div>

                <!-- Sent At -->
                <div class="flex items-center space-x-4">
                    <strong class="text-xl font-medium text-gray-800">Sent At:</strong>
                    <span class="text-lg">{{ $contact->created_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('admin.landing.contacts.index') }}"
                class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg transform hover:scale-105 transition-transform hover:bg-blue-700">
                <i class="fas fa-arrow-left mr-2"></i> Back to Messages
            </a>
        </div>
    </div>
@endsection