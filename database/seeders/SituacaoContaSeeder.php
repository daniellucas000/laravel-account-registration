<?php

namespace Database\Seeders;

use App\Models\SituacaoConta;
use Illuminate\Database\Seeder;

class SituacaoContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!SituacaoConta::where('name', 'Paga')->first()) {
            SituacaoConta::create([
                'name' => 'Paga',
                'color' => 'success',
            ]);
        }
        if (!SituacaoConta::where('name', 'Pendente')->first()) {
            SituacaoConta::create([
                'name' => 'Pendente',
                'color' => 'danger',
            ]);
        }
        if (!SituacaoConta::where('name', 'Cancelada')->first()) {
            SituacaoConta::create([
                'name' => 'Cancelada',
                'color' => 'warning',
            ]);
        }
    }
}
