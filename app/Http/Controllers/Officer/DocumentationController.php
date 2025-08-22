<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentationController extends Controller
{
    public function index()
    {
        $officer = Auth::user();
        $items = $officer->documentedItems()->with(['home'])->paginate(15);
        $items = $officer->documentedItems()->with(['home'])->paginate(15);
        
        return view('officer.items.index', compact('items'));
    }

    public function create(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        
        return view('officer.items.create', compact('appointment'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'estimated_value' => 'nullable|numeric|min:0',
            'photos.*' => 'image|max:5120' // 5MB max
        ]);

        $item = Item::create([
            'home_id' => $appointment->home_id,
            'appointment_id' => $appointment->id,
            'documented_by' => Auth::user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'estimated_value' => $validated['estimated_value']
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('items', 'public');
                $item->files()->create([
                    'file_path' => $path,
                    'file_type' => 'image',
                    'uploaded_by' => Auth::user()->id
                ]);
            }
        }

        return redirect()->route('officer.appointments.document', $appointment)
            ->with('success', 'Item documented successfully!');
    }
}
