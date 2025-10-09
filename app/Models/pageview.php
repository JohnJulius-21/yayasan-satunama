<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pageview extends Model
{
    protected $table = 'page_views';
    protected $fillable = [
        'url', 'ip_address', 'user_agent', 'session_id', 'visitor_id',
        'referrer', 'referrer_domain',
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
        'device_type', 'browser', 'platform', 'country', 'city', 'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];
}
