<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'current_version',
        'status',
    ];

    public function versions()
    {
        return $this->hasMany(DocumentVersion::class, 'document_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'document_users', 'document_id', 'user_id')
            ->withPivot('last_viewed_version')
            ->withTimestamps();
    }
}
