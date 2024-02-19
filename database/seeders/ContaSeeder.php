<?php

namespace Database\Seeders;

use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Conta::where('name', 'Energia')->first()) {
            Conta::create([
                'name' => 'Energia',
                'value' => '100.20',
                'expiration' => '2024-02-15',
            ]);
        }

        if (!Conta::where('name', 'Internet')->first()) {
            Conta::create([
                'name' => 'Internet',
                'value' => '100.20',
                'expiration' => '2024-02-15',
            ]);
        }

        if (!Conta::where('name', 'Eletricidade')->first()) {
            Conta::create([
                'name' => 'Eletricidade',
                'value' => '150.50',
                'expiration' => '2024-02-20',
            ]);
        }

        if (!Conta::where('name', 'Água')->first()) {
            Conta::create([
                'name' => 'Água',
                'value' => '80.00',
                'expiration' => '2024-02-18',
            ]);
        }

        if (!Conta::where('name', 'Telefone')->first()) {
            Conta::create([
                'name' => 'Telefone',
                'value' => '60.75',
                'expiration' => '2024-02-22',
            ]);
        }

        if (!Conta::where('name', 'Gás')->first()) {
            Conta::create([
                'name' => 'Gás',
                'value' => '90.30',
                'expiration' => '2024-02-25',
            ]);
        }

        if (!Conta::where('name', 'Aluguel')->first()) {
            Conta::create([
                'name' => 'Aluguel',
                'value' => '1200.00',
                'expiration' => '2024-02-28',
            ]);
        }

        if (!Conta::where('name', 'Seguro de carro')->first()) {
            Conta::create([
                'name' => 'Seguro de carro',
                'value' => '300.00',
                'expiration' => '2024-03-05',
            ]);
        }

        if (!Conta::where('name', 'Plano de saúde')->first()) {
            Conta::create([
                'name' => 'Plano de saúde',
                'value' => '400.00',
                'expiration' => '2024-03-10',
            ]);
        }

        if (!Conta::where('name', 'Academia')->first()) {
            Conta::create([
                'name' => 'Academia',
                'value' => '80.00',
                'expiration' => '2024-03-15',
            ]);
        }
    }
}
