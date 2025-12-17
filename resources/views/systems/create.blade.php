@extends('layouts.app')

@section('title', 'Create System Configuration')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Create System Configuration</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('systems.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="create_manage" class="block text-sm font-semibold text-gray-700 mb-2">Create/Manage</label>
                <input type="text" id="create_manage" name="create_manage" value="{{ old('create_manage') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="configure_appointment" class="block text-sm font-semibold text-gray-700 mb-2">Configure Appointment</label>
                <input type="text" id="configure_appointment" name="configure_appointment" value="{{ old('configure_appointment') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create Configuration</button>
                <a href="{{ route('systems.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
