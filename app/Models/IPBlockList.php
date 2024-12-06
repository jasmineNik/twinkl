<?php

namespace App\Models;

use Database\Factories\IPBlockListFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPBlockList extends Model
{
    /** @use HasFactory<IPBlockListFactory> */
    use HasFactory;
}
