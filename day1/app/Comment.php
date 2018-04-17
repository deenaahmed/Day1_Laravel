<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'body',
        'user_id',
    ];
    public function author()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    /**
     * Get all of the owning commentable models.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable() 
    {
        return $this->morphTo();
    }
}
