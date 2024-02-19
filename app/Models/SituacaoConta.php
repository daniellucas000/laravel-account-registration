<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoConta extends Model
{
    use HasFactory;

    //Indicar nome da tabela
    protected $table = 'situacoes_contas';

    //Indicar quais colunas podem ser cadastrada
    protected $fillable = ['name', 'color'];

    public function conta()
    {
        return $this->hasMany(Conta::class);
    }
}
