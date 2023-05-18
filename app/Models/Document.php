<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = ['created_at', 'updated_at', 'category_id', 'title', 'contents'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
