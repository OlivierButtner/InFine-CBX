<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Booking extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'inFine_bookings';

     protected $fillable = [
        'id_user',
        'id_event',
    ]; 
}