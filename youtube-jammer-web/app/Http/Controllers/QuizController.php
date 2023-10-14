<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index(Word $word, Time $time)
    {
        return view('quiz.index', ['words' => $word->inRandomOrder()->limit(4)->get(),'times' => $time->get()]);
    }

    public function store(Time $time, Request $request)
    {
        $input = $request['times'];
        $input += ['user_id' => $request->user()->id];
        $time->fill($input)->save();
        $rank = DB::table('times')->where('time', '<', $time->time)->count() + 1;
        return redirect()->route('quiz.selectmode')->with('status', $rank);
    }

    public function selectmode()
    {
        return view('quiz.selectmode');
    }
}
