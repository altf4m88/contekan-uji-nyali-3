<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const ADMIN = 'ADMIN';
    public const EMPLOYEE = 'EMPLOYEE';

    public function getAuthPassword()
    {
        return $this->password;
    }
}
