<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Index
     */
    public function index(){
        // $topics = Topic::all();
        return Inertia::render('Topics/Index', ['topics' => Topic::all()->map(function($topic){
            return [
                'id' => $topic->id,
                'name' => $topic->name,
                'image' => asset('storage/'. $topic->image)
            ];
        })]);
    }

    /**
     * Create
     */
    public function create(){
        return Inertia::render('Topics/Create');
    }

    /**
     * Store
     */
    public function store(Request $request){
       $image = $request->file('file')->store('topics', 'public');
       Topic::create([
            'name' => ucwords($request->name),
            'image' => $image,
        ]);

        return redirect()->route('topics.index')->with('success', "Topic Create Successfully!");
    }

}
