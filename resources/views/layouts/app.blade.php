<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Appointment Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="text-2xl font-bold text-blue-600">AMS</a>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('staff.index') }}" class="text-gray-600 hover:text-blue-600">Staff</a></li>
                    <li><a href="{{ route('clients.index') }}" class="text-gray-600 hover:text-blue-600">Clients</a></li>
                    <li><a href="{{ route('service-types.index') }}" class="text-gray-600 hover:text-blue-600">Services</a></li>
                    <li><a href="{{ route('appointments.index') }}" class="text-gray-600 hover:text-blue-600">Appointments</a></li>
                    <li><a href="{{ route('schedules.index') }}" class="text-gray-600 hover:text-blue-600">Schedules</a></li>
                    <li><a href="{{ route('systems.index') }}" class="text-gray-600 hover:text-blue-600">System</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        @if ($message = Session::get('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ $message }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
