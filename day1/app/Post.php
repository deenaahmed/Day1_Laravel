<?php

namespace App;

use App\Traits\CommentableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Lecturize\Tags\Traits\HasTags;

class Post extends Model
{

    use HasTags;
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
