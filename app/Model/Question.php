<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Categroy::class);
    }
}
