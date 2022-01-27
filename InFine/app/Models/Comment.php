<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'inFine_comments';

     protected $fillable = [
         'content',
        'id_user',
        'id_event',
        'pictures',
    ]; 
}