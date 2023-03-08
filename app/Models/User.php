<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'document_id',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
