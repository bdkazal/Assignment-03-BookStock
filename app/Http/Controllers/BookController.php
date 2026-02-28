<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = DB::table('books')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select(
                'books.*',
                'authors.name as author_name',
                'categories.name as category_name'
            )

            ->orderByDesc('books.id')
            ->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->orderBy('name')->get();
        $authors = DB::table('authors')->orderBy('name')->get();

        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', 'unique:books,isbn'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'in:available,borrowed'],
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            // saves to storage/ap/public/covers
            // returns path like: covers/filename.jpg
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        DB::table('books')->insert([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'cover_image' => $coverPath,
            'description' => $request->description,
            'published_at' => $request->published_at,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
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
        $book = DB::table('books')->where('id', $id)->first();

        $categories = DB::table('categories')->orderBy('name')->get();
        $authors = DB::table('authors')->orderBy('name')->get();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', "unique:books,isbn,$id"],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'in:available,borrowed'],
        ]);

        // Keep old file path if no new file is uploaded
        $coverPath = $book->cover_image;

        // If new file is uploaded, store it and delete old file
        if ($request->hasFile('cover_image')) {
            // delete old file if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            // store new file
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        DB::table('books')->where('id', $id)->update([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'cover_image' => $coverPath,
            'description' => $request->description,
            'published_at' => $request->published_at,
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        // delete cover image file if exists
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        DB::table('books')->where('id', $id)->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
