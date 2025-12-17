@extends('layouts.app')

@section('title', 'Edit Service Type')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Edit Service Type</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('service-types.update', $serviceType) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-6">
                <label for="service_name" class="block text-sm font-semibold text-gray-700 mb-2">Service Name *</label>
                <input type="text" id="service_name" name="service_name" value="{{ old('service_name', $serviceType->service_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('service_name') border-red-500 @enderror">
                @error('service_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">Duration (minutes) *</label>
                <input type="number" id="duration" name="duration" value="{{ old('duration', $serviceType->duration) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('duration') border-red-500 @enderror">
                @error('duration')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Cost *</label>
                <input type="number" id="cost" name="cost" value="{{ old('cost', $serviceType->cost) }}" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('cost') border-red-500 @enderror">
                @error('cost')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('description', $serviceType->description) }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Service</button>
                <a href="{{ route('service-types.show', $serviceType) }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
