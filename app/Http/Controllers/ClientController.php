<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'personal_info' => 'nullable|string',
            'contact_info' => 'nullable|string|max:255',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'personal_info' => 'nullable|string',
            'contact_info' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('clients.show', $client)->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            // Ensure dependent appointments are removed first to avoid FK constraint failures.
            $client->appointments()->delete();

            $client->delete();

            return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
        } catch (QueryException $e) {
            return redirect()->route('clients.index')->with('error', 'Unable to delete client because related records exist.');
        } catch (\Exception $e) {
            return redirect()->route('clients.index')->with('error', 'An unexpected error occurred while deleting the client.');
        }
    }
}
