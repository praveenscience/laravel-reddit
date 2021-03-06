<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'link',
        'text',
        'image',
        'subreddit_id'
    ];

    protected $primaryKey = 'subreddit_id';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function subreddit() {
        return $this->belongsTo('App\Subreddit');
    }

    public function votes() {
        return $this->hasMany('App\Vote');
    }
}
