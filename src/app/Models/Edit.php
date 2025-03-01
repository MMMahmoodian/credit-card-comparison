<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
    protected $fillable = ['edits'];

    protected $casts = [
        'edits' => 'array'
    ];

    public function editable()
    {
        return $this->morphTo();
    }
}
