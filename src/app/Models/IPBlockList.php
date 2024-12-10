<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use src\database\factories\IPBlockListFactory;

class IPBlockList extends Model
{
    /** @use HasFactory<IPBlockListFactory> */
    use HasFactory;
}
