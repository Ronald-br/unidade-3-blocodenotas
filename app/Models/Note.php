<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}