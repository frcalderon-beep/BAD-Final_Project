<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Staff;
use App\Models\System;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['staff', 'system'])->paginate(10);
        return view('schedules.index', ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = Staff::all();
        $systems = System::all();

        return view('schedules.create', [
            'staff' => $staff,
            'systems' => $systems,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'system_id' => 'required|exists:systems,id',
            'time' => 'required|date_format:Y-m-d\TH:i',
            'available_slots' => 'required|integer|min:1',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return view('schedules.show', ['schedule' => $schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $staff = Staff::all();
        $systems = System::all();

        return view('schedules.edit', [
            'schedule' => $schedule,
            'staff' => $staff,
            'systems' => $systems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'system_id' => 'required|exists:systems,id',
            'time' => 'required|date_format:Y-m-d\TH:i',
            'available_slots' => 'required|integer|min:1',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.show', $schedule)->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
