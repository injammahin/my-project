@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-4xl font-extrabold mb-6 text-gray-900">Contact Messages</h1>

        @if(session('success'))
            <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-800 border border-green-400 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display messages -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full bg-white border-separate border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-green-600 text-white">
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Subject</th>
                        <th class="px-6 py-3 text-left">Message</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($messages as $message)
                        <tr class="hover:bg-gray-100 transition ease-in-out duration-300">
                            <td class="px-6 py-4 border-b">{{ $message->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $message->email }}</td>
                            <td class="px-6 py-4 border-b">{{ $message->subject }}</td>
                            <td class="px-6 py-4 border-b">{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                            <td class="px-6 py-4 border-b flex space-x-4">
                                <!-- View Button -->
                                <a href="{{ route('admin.landing.contacts.show', $message->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition duration-300">
                                    <i class="fas fa-eye w-6 h-6"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.landing.contacts.destroy', $message->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300">
                                        <i class="fas fa-trash-alt w-6 h-6"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Confirm Deletion</h3>
            <p class="text-gray-700 mb-4">Are you sure you want to delete this message?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDelete"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300">Cancel</button>
                <button id="confirmDelete"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">Delete</button>
            </div>
        </div>
    </div>

    <script>
        let deleteMessageId = null;

        function openDeleteModal(messageId) {
            deleteMessageId = messageId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deleteModal').classList.add('hidden');
        });

        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (deleteMessageId) {
                window.location.href = `/admin/landing/contacts/${deleteMessageId}/delete`;
            }
        });
    </script>
@endsection