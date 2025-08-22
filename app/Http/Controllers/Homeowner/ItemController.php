<?php

namespace App\Http\Controllers\Homeowner;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $items = Item::whereHas('home', function($query) use ($user) {
            $query->where('owner_id', $user->id);
        })->with(['home', 'documentedBy'])->paginate(15);

        $stats = [
            'total_items' => $items->total(),
            'documented_items' => Item::whereHas('home', function($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->whereNotNull('documented_by')->count(),
            'total_value' => Item::whereHas('home', function($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->sum('estimated_value')
        ];

        return view('homeowner.items.index', compact('items', 'stats'));
    }

    public function show(Item $item)
    {
        $this->authorize('view', $item);
        
        return view('homeowner.items.show', compact('item'));
    }
}
