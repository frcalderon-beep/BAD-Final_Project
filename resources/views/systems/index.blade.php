@extends('layouts.app')

@section('title', 'System Configuration')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800">System Configurations</h1>
        <a href="{{ route('systems.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            New Configuration
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Create/Manage</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Configure Appointment</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($systems as $system)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-700">{{ $system->id }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $system->create_manage ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $system->configure_appointment ?? '-' }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('systems.show', $system) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                View
                            </a>
                            <a href="{{ route('systems.edit', $system) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('systems.destroy', $system) }}" method="POST" class="inline">
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
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No configurations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($systems->hasPages())
        <div class="flex justify-center mt-6">
            {{ $systems->links() }}
        </div>
    @endif
</div>
@endsection
