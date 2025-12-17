@extends('layouts.app')

@section('title', 'Appointments Management')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800">Appointments</h1>
        <a href="{{ route('appointments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            New Appointment
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Service</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Client</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Staff</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Date/Time</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-4 text-gray-700">{{ $appointment->serviceType->service_name ?? '-' }}</td>
                        <td class="px-4 py-4 text-gray-700">{{ $appointment->client->name ?? '-' }}</td>
                        <td class="px-4 py-4 text-gray-700">{{ $appointment->staff->name ?? '-' }}</td>
                        <td class="px-4 py-4 text-gray-700">{{ $appointment->appointment_date_time->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-4"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">{{ $appointment->appointment_status }}</span></td>
                        <td class="px-4 py-4 text-center space-x-1">
                            <a href="{{ route('appointments.show', $appointment) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">View</a>
                            <a href="{{ route('appointments.edit', $appointment) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($appointments->hasPages())
        <div class="flex justify-center mt-6">
            {{ $appointments->links() }}
        </div>
    @endif
</div>
@endsection
