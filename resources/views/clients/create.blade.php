@extends('layouts.app')

@section('title', 'Add New Client')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Add New Client</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="contact_info" class="block text-sm font-semibold text-gray-700 mb-2">Contact Info</label>
                <input type="text" id="contact_info" name="contact_info" value="{{ old('contact_info') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="personal_info" class="block text-sm font-semibold text-gray-700 mb-2">Personal Info</label>
                <textarea id="personal_info" name="personal_info" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('personal_info') }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create Client</button>
                <a href="{{ route('clients.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
