<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Word $words)
    {
        return view('words.index', ['words' => $words->get()]);
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
        return redirect('/words/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return redirect('/words/index');
    }
}
