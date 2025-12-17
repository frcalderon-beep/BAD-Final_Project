@extends('layouts.app')

@section('title', 'Schedules Management')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800">Schedules</h1>
        <a href="{{ route('schedules.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            New Schedule
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Staff</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date/Time</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Available Slots</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $schedule)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-700">{{ $schedule->staff->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $schedule->time->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $schedule->available_slots }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('schedules.show', $schedule) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                View
                            </a>
                            <a href="{{ route('schedules.edit', $schedule) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline">
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
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No schedules found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($schedules->hasPages())
        <div class="flex justify-center mt-6">
            {{ $schedules->links() }}
        </div>
    @endif
</div>
@endsection
