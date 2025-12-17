@extends('layouts.app')

@section('title', 'Create Schedule')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Create New Schedule</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="staff_id" class="block text-sm font-semibold text-gray-700 mb-2">Staff *</label>
                <select id="staff_id" name="staff_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('staff_id') border-red-500 @enderror">
                    <option value="">Select Staff</option>
                    @foreach ($staff as $member)
                        <option value="{{ $member->id }}" {{ old('staff_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                    @endforeach
                </select>
                @error('staff_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="system_id" class="block text-sm font-semibold text-gray-700 mb-2">System *</label>
                <select id="system_id" name="system_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('system_id') border-red-500 @enderror">
                    <option value="">Select System</option>
                    @foreach ($systems as $system)
                        <option value="{{ $system->id }}" {{ old('system_id') == $system->id ? 'selected' : '' }}>System {{ $system->id }}</option>
                    @endforeach
                </select>
                @error('system_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="time" class="block text-sm font-semibold text-gray-700 mb-2">Date & Time *</label>
                <input type="datetime-local" id="time" name="time" value="{{ old('time') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('time') border-red-500 @enderror">
                @error('time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="available_slots" class="block text-sm font-semibold text-gray-700 mb-2">Available Slots *</label>
                <input type="number" id="available_slots" name="available_slots" value="{{ old('available_slots', 1) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('available_slots') border-red-500 @enderror">
                @error('available_slots')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create Schedule</button>
                <a href="{{ route('schedules.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
