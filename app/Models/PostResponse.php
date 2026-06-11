<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PostResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'craftsman_id',
        'message',
        'offered_price',
        'estimated_days',
        'status',
    ];

    protected $casts = ['offered_price' => 'decimal:2'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($response) {
            // زيادة عدد الردود على المنشور
            $response->post()->increment('responses_count');
        });
    }

    public function post()
    {
        return $this->belongsTo(ServicePost::class, 'post_id');
    }

    public function craftsman()
    {
        return $this->belongsTo(Craftsman::class);
    }
}
