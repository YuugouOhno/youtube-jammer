<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index(Word $word, Time $time, $mode)
    {   
        $limit = 1;
        if($mode == 1) {
            $limit = 10;
        } elseif ($mode == 2) {
            $limit = 50;
        } elseif ($mode == 3) {
            $limit = 100;
        }
        return view('quiz.index', ['words' => $word->inRandomOrder()->limit($limit)->get(),'times' => $time->get(),'mode' => $mode]);
    }

    public function store(Time $time, Request $request)
    {
        $input = $request['times'];
        $input += ['user_id' => $request->user()->id];
        $time->fill($input)->save();
        $rank = DB::table('times')->where('mode', '=', $time->mode)->where('time', '<', $time->time)->count() + 1;
        return redirect()->route('quiz.selectmode')->with('rank',$rank)->with('mode', $time->mode);
    }

    public function selectmode()
    {
        return view('quiz.selectmode');
    }
}
