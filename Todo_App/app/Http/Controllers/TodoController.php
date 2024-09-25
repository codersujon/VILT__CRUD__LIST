<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::whereUserId(auth()->user()->id)->get();
        return Inertia::render('Todo', ['todos'=>$todos]);
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
        //Validation
        $todo = $request->validate(['content' => 'required']);
        $todo['user_id'] = auth()->user()->id;
        $todo['isDone'] = false;

        // Create
        Todo::create($todo);

        return redirect('todos')->with('success', "Todo Created Successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->isDone = !$todo->isDone;
        $todo->update();
        return redirect('todos')->with('success', "Todo Done!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
