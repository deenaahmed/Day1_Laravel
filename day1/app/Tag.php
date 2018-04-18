<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_body',
    ];


    /**
     * Get all of the owning commentable models.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */

}
