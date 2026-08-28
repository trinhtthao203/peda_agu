<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Feedback extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'feedbacks';

    protected $fillable = [
        'sender_type',
        'topic',
        'fullname',
        'contact',
        'content',
        'ip_address',
        'user_agent',
        'status',
        'assigned_to',
        'assigned_at',
        'response_content',
        'responder_name',
        'responded_at',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'assigned_at'  => 'datetime',
        'responded_at' => 'datetime',
        'published_at' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];
}
