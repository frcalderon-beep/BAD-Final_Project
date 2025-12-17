@extends('layouts.app')

@section('title', 'View Service Type')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">{{ $serviceType->service_name }}</h1>
        <a href="{{ route('service-types.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Details</h2>
            <div class="mt-4 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Duration</p>
                    <p class="text-gray-700">{{ $serviceType->duration }} minutes</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Cost</p>
                    <p class="text-gray-700">${{ number_format($serviceType->cost, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Description</p>
                    <p class="text-gray-700">{{ $serviceType->description ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Created At</p>
                    <p class="text-gray-700">{{ $serviceType->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('service-types.edit', $serviceType) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <form action="{{ route('service-types.destroy', $serviceType) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
