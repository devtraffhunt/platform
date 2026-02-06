<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'name',
        'support_contact',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
