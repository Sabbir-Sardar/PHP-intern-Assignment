<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TodoController extends Controller
{
    // Display the To-Do list
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    // Store new To-Do
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string',
        ]);

        $todo = Todo::create([
            'task' => $request->task,
            'is_completed' => false,
        ]);

        return response()->json($todo);
    }

    // Mark To-Do as complete
    public function complete($id)
    {
        $todo = Todo::find($id);
        $todo->is_completed = true;
        $todo->save();

        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id); // Find the todo by ID
        $todo->delete(); // Delete the todo from the database

        return response()->json(['success' => 'Todo deleted successfully']);
    }
}
