<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public const DRAFT = 'DRAFT';
    public const ONPROGRESS = 'ONPROGRESS';
    public const DONE = 'DONE';

    public function civillian() {
        return $this->belongsTo(Civillian::class);
    }
}
