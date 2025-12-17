@extends('layouts.app')

@section('title', 'Client Management')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800">Clients</h1>
        <a href="{{ route('clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add New Client
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Contact Info</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Personal Info</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-700">{{ $client->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $client->contact_info ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ Str::limit($client->personal_info ?? '-', 50) }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('clients.show', $client) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                View
                            </a>
                            <a href="{{ route('clients.edit', $client) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No clients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($clients->hasPages())
        <div class="flex justify-center mt-6">
            {{ $clients->links() }}
        </div>
    @endif
</div>
@endsection
