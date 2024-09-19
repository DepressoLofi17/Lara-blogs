<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'deck_id',
        'title',
        'file',
        'content'
    ];

    public function deck()
    {
        return $this->belongsTo(Deck::class, 'deck_id');
    }
}
