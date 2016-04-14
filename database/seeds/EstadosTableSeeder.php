<?php

use Illuminate\Database\Seeder;
use App\Estado as Estado;

class EstadosTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
    Estado::create(['nome' =>'Acre','UF' => 'AC',]);
    Estado::create(['nome' =>'Alagoas','UF' => 'AL',]);
    Estado::create(['nome' =>'Amazonas','UF' => 'AM',]);
    Estado::create(['nome' =>'Amapá','UF' => 'AP',]);
    Estado::create(['nome' =>'Bahia','UF' => 'BA',]);
    Estado::create(['nome' =>'Ceará','UF' => 'CE',]);
    Estado::create(['nome' =>'Distrito Federal','UF' => 'DF',]);
    Estado::create(['nome' =>'Espírito Santo','UF' => 'ES',]);
    Estado::create(['nome' =>'Goiás','UF' => 'GO',]);
    Estado::create(['nome' =>'Maranhão','UF' => 'MA',]);
    Estado::create(['nome' =>'Minas Gerais','UF' => 'MG',]);
    Estado::create(['nome' =>'Mato Grosso do Sul','UF' => 'MS',]);
    Estado::create(['nome' =>'Mato Grosso','UF' => 'MT',]);
    Estado::create(['nome' =>'Pará','UF' => 'PA',]);
    Estado::create(['nome' =>'Paraíba','UF' => 'PB',]);
    Estado::create(['nome' =>'Pernambuco','UF' => 'PE',]);
    Estado::create(['nome' =>'Piauí','UF' => 'PI',]);
    Estado::create(['nome' =>'Paraná','UF' => 'PR',]);
    Estado::create(['nome' =>'Rio de Janeiro','UF' => 'RJ',]);
    Estado::create(['nome' =>'Rio Grande do Norte','UF' => 'RN',]);
    Estado::create(['nome' =>'Rondônia','UF' => 'RO',]);
    Estado::create(['nome' =>'Roraima','UF' => 'RR',]);
    Estado::create(['nome' =>'Rio Grande do Sul','UF' => 'RS',]);
    Estado::create(['nome' =>'Santa Catarina','UF' => 'SC',]);
    Estado::create(['nome' =>'Sergipe','UF' => 'SE',]);
    Estado::create(['nome' =>'São Paulo','UF' => 'SP',]);
    Estado::create(['nome' =>'Tocantins','UF' => 'TO',]);


    }
}
