<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            ['pt_BR' => 'Acupuntura'],
            ['pt_BR' => 'Alergologia'],
            ['pt_BR' => 'Anestesiologia'],
            ['pt_BR' => 'Cardiologia'],
            ['pt_BR' => 'Cirurgia Cabeça e Pescoço'],
            ['pt_BR' => 'Cirurgia Cardíaca'],
            ['pt_BR' => 'Cirurgia Cardiovascular'],
            ['pt_BR' => 'Cirurgia Geral'],
            ['pt_BR' => 'Cirurgia Infantil'],
            ['pt_BR' => 'Cirurgia Plástica'],
            ['pt_BR' => 'Cirurgia Torácica'],
            ['pt_BR' => 'Cirurgia Vascular'],
            ['pt_BR' => 'Clínica médica'],
            ['pt_BR' => 'Colonoscopia'],
            ['pt_BR' => 'Dermatologia'],
            ['pt_BR' => 'Endocrinologia'],
            ['pt_BR' => 'Endoscopia'],
            ['pt_BR' => 'Fisiatria'],
            ['pt_BR' => 'Fisioterapia'],
            ['pt_BR' => 'Fonoaudiologia'],
            ['pt_BR' => 'Gastroenterologia'],
            ['pt_BR' => 'Geriatria'],
            ['pt_BR' => 'Ginecologia e Obstetrícia'],
            ['pt_BR' => 'Hematologia'],
            ['pt_BR' => 'Infectologia'],
            ['pt_BR' => 'Mastologia'],
            ['pt_BR' => 'Nefrologia'],
            ['pt_BR' => 'Neurocirurgia'],
            ['pt_BR' => 'Neurologia'],
            ['pt_BR' => 'Nutrologia'],
            ['pt_BR' => 'Odontologia Cirurgia Bucomaxilo Facial e OPNE'],
            ['pt_BR' => 'Odontologia Hospitalar'],
            ['pt_BR' => 'Oftalmologia'],
            ['pt_BR' => 'Oncologia'],
            ['pt_BR' => 'Ortopedia'],
            ['pt_BR' => 'Otorrinolaringologia'],
            ['pt_BR' => 'Pediatria'],
            ['pt_BR' => 'Pneumologia'],
            ['pt_BR' => 'Proctologia'],
            ['pt_BR' => 'Psicologia'],
            ['pt_BR' => 'Psiquiatria'],
            ['pt_BR' => 'Radiologia'],
            ['pt_BR' => 'Reumatologia'],
            ['pt_BR' => 'Urologia'],
        ];
        foreach($list as $item){
            $Speciality = new Speciality();
            $Speciality->title = json_encode($item);
            $Speciality->save();
        }
    }
}
