<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome','cep','logradouro','complemento','identidade','telefone','data_nascimento'];
    protected $dates = [
        'data_nascimento'
    ];
}
