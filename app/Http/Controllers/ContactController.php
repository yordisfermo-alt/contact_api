<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json([
            'message' => 'Contacto obtenidos correctamente',
            'data' => $contacts,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'phone_number' => ['nullable', 'string', 'max:255']
        ]);

        $contact = Contact::create($data);
        return response()->json([
            'message' => 'Contacto creado correctamente',
            'data' => $contact,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return response()->json([
            'message' => 'Contacto obtenido correctamente',
            'data' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name' => ['sometimes','required', 'string', 'max:255'],
            'user_id' => ['sometimes', 'required', 'exists:users,id'],
            'phone_number' => ['nullable', 'string', 'max:255']
        ]);

        $contact->update($data);
        return response()->json([
            'message' => 'Contacto actualizado correctamente',
            'data' => $contact,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json([
            'message' => 'Contacto eliminado correctamente',
        ]);
    }
}
