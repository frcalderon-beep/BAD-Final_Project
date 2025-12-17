<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::paginate(10);
        return view('staff.index', ['staff' => $staff]);
        try {
            $staff->delete();
            return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
        } catch (QueryException $e) {
            // Return a friendly message if a DB constraint prevents deletion
            return redirect()->route('staff.index')->with('error', 'Unable to delete staff member because related records exist.');
        } catch (\Exception $e) {
            return redirect()->route('staff.index')->with('error', 'An unexpected error occurred while deleting the staff member.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'personal_info' => 'nullable|string',
            'assigned_appointment' => 'nullable|string',
            'contact_info' => 'nullable|string|max:255',
        ]);

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return view('staff.show', ['staff' => $staff]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', ['staff' => $staff]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'personal_info' => 'nullable|string',
            'assigned_appointment' => 'nullable|string',
            'contact_info' => 'nullable|string|max:255',
        ]);

        $staff->update($validated);

        return redirect()->route('staff.show', $staff)->with('success', 'Staff member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
