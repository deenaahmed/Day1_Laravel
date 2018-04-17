<?php

namespace App;

use App\Traits\CommentableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CommentableTrait;
	use Sluggable;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'photo',
    ];

    public function user()
    {
        //User::class == 'App\User'
        return $this->belongsTo(User::class);
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
