<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id ',
        'user_id ',
        'last_viewed_version',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
