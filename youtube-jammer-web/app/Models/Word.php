<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Tag;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'en_word',
        'ja_word',
        'en_sentence',
        'ja_sentence',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
