<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Word $words)
    {
        return view('cards.index', ['words' => $words->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('words.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Word $word)
    {
        $input = $request['word'];
        $input += ['user_id' => $request->user()->id];

        $word->fill($input)->save();
        return redirect()->route('word.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        return view('words.show', ['word' => $word]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        return view('words.edit', ['word' => $word]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        $input = $request['word'];
        $input += ['user_id' => $request->user()->id];
        $word->fill($input)->save();
        return redirect()->route('word.show', ['word' => $word->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return redirect()->route('word.index');
    }
}
