<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // import SoftDeletes

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes; // menggunakan class SoftDeletes
}