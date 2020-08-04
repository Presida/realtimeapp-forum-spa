<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];
    // Ignore mass assignment and fill every fields
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPathAttribute()
    {
        return asset("api/question/$this->slug");
    }

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
