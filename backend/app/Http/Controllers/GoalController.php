<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller {
    // Fetch all goals (GET)
    public function index() {
        return response()->json(Goal::all());
    }

    // Store a new goal (POST)
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        $goal = Goal::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return response()->json($goal, 201);
    }
    public function show($id) {
        $goal = Goal::findOrFail($id);
        return response()->json($goal);
    }
}
