@extends('layouts.app')

@section('title', 'View Appointment')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">Appointment Details</h1>
        <a href="{{ route('appointments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-sm text-gray-500">Client</p>
                <p class="text-lg text-gray-700">{{ $appointment->client->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Staff</p>
                <p class="text-lg text-gray-700">{{ $appointment->staff->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Service</p>
                <p class="text-lg text-gray-700">{{ $appointment->serviceType->service_name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date & Time</p>
                <p class="text-lg text-gray-700">{{ $appointment->appointment_date_time->format('M d, Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="text-lg"><span class="px-3 py-1 bg-blue-100 text-blue-800 rounded">{{ $appointment->appointment_status }}</span></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Created At</p>
                <p class="text-lg text-gray-700">{{ $appointment->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <div class="mb-6">
            <p class="text-sm text-gray-500">Notes</p>
            <p class="text-gray-700">{{ $appointment->notes ?? 'No notes' }}</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('appointments.edit', $appointment) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
