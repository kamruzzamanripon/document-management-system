<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDiff extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id ',
        'document_version_id ',
        'diff_body_content',
        'diff_tags_content',
    ];
}
