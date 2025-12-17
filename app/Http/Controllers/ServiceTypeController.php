<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceTypes = ServiceType::paginate(10);
        return view('service-types.index', ['serviceTypes' => $serviceTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
        ]);

        ServiceType::create($validated);

        return redirect()->route('service-types.index')->with('success', 'Service type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceType $serviceType)
    {
        return view('service-types.show', ['serviceType' => $serviceType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceType $serviceType)
    {
        return view('service-types.edit', ['serviceType' => $serviceType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
        ]);

        $serviceType->update($validated);

        return redirect()->route('service-types.show', $serviceType)->with('success', 'Service type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();

        return redirect()->route('service-types.index')->with('success', 'Service type deleted successfully.');
    }
}
