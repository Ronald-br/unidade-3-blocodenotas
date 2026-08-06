<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
    ];

    // Criptografa automaticamente antes de salvar no banco
    public function setConteudoAttribute($value)
    {
        $this->attributes['conteudo'] = Crypt::encryptString($value);
    }

    // Descriptografa automaticamente quando buscar do banco
    public function getConteudoAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}