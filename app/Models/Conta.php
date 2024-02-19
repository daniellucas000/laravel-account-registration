<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    //Indicar nome da tabela
    protected $table = 'contas';

    //Indicar quais colunas podem ser cadastrada
    protected $fillable = ['name', 'value', 'expiration', 'situacao_conta_id'];

    public function situacaoConta()
    {
        return $this->belongsTo(SituacaoConta::class);
    }
}
