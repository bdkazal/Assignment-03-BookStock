<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = DB::table('authors')->orderByDesc('id')->get();
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255', 'unique:authors,name']]);

        DB::table('authors')->insert([
            'name' => $request->name,
            'bio' => $request->bio,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $author = DB::table('authors')->where('id', $id)->first();
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:authors,name,$id"],
            'bio' => ['nullable', 'string'],
        ]);

        DB::table('authors')->where('id', $id)->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'updated_at' => now()
        ]);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('authors')->where('id', $id)->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
