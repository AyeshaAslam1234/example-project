<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
      use Searchable;

    protected $fillable = [
        'title',
        'body',
    ];

     // Optional: define what fields Scout should index
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body'  => $this->body,
        ];
    }
}
