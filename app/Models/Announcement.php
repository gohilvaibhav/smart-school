<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'body',
        'target_role',
        'visible_to',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
