<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

    /**
     * Topic Edit
     */
    public function edit(Topic $topic){
        return Inertia::render('Topics/Edit', [
            'topic' => $topic,
            'image' => asset('storage/' . $topic->image)
        ]);
    }

    /**
     * Update Topic
     */
    public function update(Request $request, Topic $topic){

        $image = $topic->file;
        if($request->file('file')){
            $image_path = public_path('storage/'.$topic->image);
            unlink($image_path);
            $image = $request->file('file')->store('topics', 'public');
        }

        $topic->update([
            'name' => $request->name,
            'image' => $image
        ]);

        return redirect()->route('topics.index')->with('success', "Topic Updated Successfully!");
    }

    /**
     * Destroy
     */

     public function destroy(Topic $topic){
        // Delete Image from Storage
        $image_path = public_path('storage/'.$topic->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $topic->delete();
        return redirect()->route('topics.index')->with('success', "Topic Deleted Successfully!");
     }

}

