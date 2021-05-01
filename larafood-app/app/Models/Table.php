<?php

namespace App\Models;

use App\Companies\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use CompanyTrait;

    protected $fillable = ['identify', 'description'];
}