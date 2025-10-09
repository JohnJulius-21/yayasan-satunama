<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class conversionevent extends Model
{
    protected $table = 'conversion_events';
    protected $fillable = [
        'visitor_id', 'session_id', 'event_name', 'event_data',
        'url', 'utm_source', 'utm_campaign',
    ];

    protected $casts = [
        'event_data' => 'array',
    ];
}
