<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = System::paginate(10);
        return view('systems.index', ['systems' => $systems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('systems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'create_manage' => 'nullable|string|max:255',
            'configure_appointment' => 'nullable|string|max:255',
        ]);

        System::create($validated);

        return redirect()->route('systems.index')->with('success', 'System configuration created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(System $system)
    {
        return view('systems.show', ['system' => $system]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(System $system)
    {
        return view('systems.edit', ['system' => $system]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, System $system)
    {
        $validated = $request->validate([
            'create_manage' => 'nullable|string|max:255',
            'configure_appointment' => 'nullable|string|max:255',
        ]);

        $system->update($validated);

        return redirect()->route('systems.show', $system)->with('success', 'System configuration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(System $system)
    {
        $system->delete();

        return redirect()->route('systems.index')->with('success', 'System configuration deleted successfully.');
    }
}
