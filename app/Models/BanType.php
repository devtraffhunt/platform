<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanType extends Model
{
    protected $table = 'bans_types';

    protected $fillable = [
        'name',
        'rules_json',
    ];

    protected $casts = [
        'rules_json' => 'array', // Laravel будет автоматически декодировать JSON в массив
    ];

    // Если есть связь с User (например, поле user.ban_type_id)
    public function users()
    {
        return $this->hasMany(User::class, 'ban_id');
    }
}
