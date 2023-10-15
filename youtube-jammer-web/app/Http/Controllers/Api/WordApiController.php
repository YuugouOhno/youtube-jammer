<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Word;
use App\Http\Resources\WordApiResource;
use App\Http\Requests\WordApiRequest;

class WordApiController extends Controller
{
    public function random10() {
        $word = Word::inRandomOrder()->limit(10)->get();
        return response()->json($word);
    }

    
}
