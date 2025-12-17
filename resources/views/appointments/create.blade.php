@extends('layouts.app')

@section('title', 'Create Appointment')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Create New Appointment</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

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
                <label for="client_id" class="block text-sm font-semibold text-gray-700 mb-2">Client *</label>
                <select id="client_id" name="client_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('client_id') border-red-500 @enderror">
                    <option value="">Select Client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

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
                <label for="service_type_id" class="block text-sm font-semibold text-gray-700 mb-2">Service Type *</label>
                <select id="service_type_id" name="service_type_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('service_type_id') border-red-500 @enderror">
                    <option value="">Select Service</option>
                    @foreach ($serviceTypes as $service)
                        <option value="{{ $service->id }}" {{ old('service_type_id') == $service->id ? 'selected' : '' }}>{{ $service->service_name }}</option>
                    @endforeach
                </select>
                @error('service_type_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="service_name" class="block text-sm font-semibold text-gray-700 mb-2">Service Name *</label>
                <input type="text" id="service_name" name="service_name" value="{{ old('service_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('service_name') border-red-500 @enderror">
                @error('service_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="appointment_date_time" class="block text-sm font-semibold text-gray-700 mb-2">Date & Time *</label>
                <input type="datetime-local" id="appointment_date_time" name="appointment_date_time" value="{{ old('appointment_date_time') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('appointment_date_time') border-red-500 @enderror">
                @error('appointment_date_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="appointment_status" class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                <select id="appointment_status" name="appointment_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('appointment_status') border-red-500 @enderror">
                    <option value="scheduled" {{ old('appointment_status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="completed" {{ old('appointment_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('appointment_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('appointment_status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="personal_references" class="block text-sm font-semibold text-gray-700 mb-2">Personal References</label>
                <textarea id="personal_references" name="personal_references" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('personal_references') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                <textarea id="notes" name="notes" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('notes') }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create Appointment</button>
                <a href="{{ route('appointments.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
