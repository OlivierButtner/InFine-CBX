<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Event extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'inFine_events';

     protected $fillable = [
        'title',
        'description',
        'keywords',
        'adresse',
        'location',
        'pictures',
        'users',
        'note',
    ]; 
}