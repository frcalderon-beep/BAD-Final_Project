<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Staff;
use App\Models\ServiceType;
use App\Models\System;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['client', 'staff', 'serviceType'])->paginate(10);
        return view('appointments.index', ['appointments' => $appointments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $staff = Staff::all();
        $serviceTypes = ServiceType::all();
        $systems = System::all();

        return view('appointments.create', [
            'clients' => $clients,
            'staff' => $staff,
            'serviceTypes' => $serviceTypes,
            'systems' => $systems,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'system_id' => 'required|exists:systems,id',
            'client_id' => 'required|exists:clients,id',
            'staff_id' => 'required|exists:staff,id',
            'service_type_id' => 'required|exists:service_types,id',
            'service_name' => 'required|string|max:255',
            'appointment_date_time' => 'required|date_format:Y-m-d\TH:i',
            'personal_references' => 'nullable|string',
            'appointment_status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', ['appointment' => $appointment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $staff = Staff::all();
        $serviceTypes = ServiceType::all();
        $systems = System::all();

        return view('appointments.edit', [
            'appointment' => $appointment,
            'clients' => $clients,
            'staff' => $staff,
            'serviceTypes' => $serviceTypes,
            'systems' => $systems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'system_id' => 'required|exists:systems,id',
            'client_id' => 'required|exists:clients,id',
            'staff_id' => 'required|exists:staff,id',
            'service_type_id' => 'required|exists:service_types,id',
            'service_name' => 'required|string|max:255',
            'appointment_date_time' => 'required|date_format:Y-m-d\TH:i',
            'personal_references' => 'nullable|string',
            'appointment_status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
