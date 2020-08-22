<?php

namespace App\Model;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Generate slug (method2)
    protected static function boot() {
        parent::boot();
        static::creating(function($question) {
            $question->slug = Str::slug($question->title);
        });
    }

    protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];
    // Ignore mass assignment and fill every fields
    // protected $guarded = [];

    protected $with = ['replies'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function category()
    {
        return $this->belongsTo(Categroy::class);
    }
}
