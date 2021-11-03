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
            ['pt_BR' => 'Alergia e Imunologia'],
            ['pt_BR' => 'Anestesiologia'],
            ['pt_BR' => 'Angiologia'],
            ['pt_BR' => 'Cardiologia'],
            ['pt_BR' => 'Cirurgia Cardiovascular'],
            ['pt_BR' => 'Cirurgia da Mão'],
            ['pt_BR' => 'Cirurgia de Cabeça e Pescoço'],
            ['pt_BR' => 'Cirurgia do Aparelho Digestivo'],
            ['pt_BR' => 'Cirurgia Geral'],
            ['pt_BR' => 'Cirurgia Oncológica'],
            ['pt_BR' => 'Cirurgia Pediátrica'],
            ['pt_BR' => 'Cirurgia Plástica'],
            ['pt_BR' => 'Cirurgia Torácica'],
            ['pt_BR' => 'Cirurgia Vascular'],
            ['pt_BR' => 'Clínica Médica'],
            ['pt_BR' => 'Coloproctologia'],
            ['pt_BR' => 'Dermatologia'],
            ['pt_BR' => 'Endocrinologia e Metabologia'],
            ['pt_BR' => 'Endoscopia'],
            ['pt_BR' => 'Gastroenterologia'],
            ['pt_BR' => 'Genética Médica'],
            ['pt_BR' => 'Geriatria'],
            ['pt_BR' => 'Ginecologia e Obstetrícia'],
            ['pt_BR' => 'Hematologia e Hemoterapia'],
            ['pt_BR' => 'Homeopatia'],
            ['pt_BR' => 'Infectologia'],
            ['pt_BR' => 'Mastologia'],
            ['pt_BR' => 'Medicina de Emergência'],
            ['pt_BR' => 'Medicina de Família e Comunidade'],
            ['pt_BR' => 'Medicina do Trabalho'],
            ['pt_BR' => 'Medicina de Tráfego'],
            ['pt_BR' => 'Medicina Esportiva'],
            ['pt_BR' => 'Medicina Física e Reabilitação'],
            ['pt_BR' => 'Medicina Intensiva'],
            ['pt_BR' => 'Medicina Legal e Perícia Médica'],
            ['pt_BR' => 'Medicina Nuclear'],
            ['pt_BR' => 'Medicina Preventiva e Social'],
            ['pt_BR' => 'Nefrologia'],
            ['pt_BR' => 'Neurocirurgia'],
            ['pt_BR' => 'Neurologia'],
            ['pt_BR' => 'Nutricionista'],
            ['pt_BR' => 'Nutrologia'],
            ['pt_BR' => 'Oftalmologia'],
            ['pt_BR' => 'Oncologia Clínica'],
            ['pt_BR' => 'Ortopedia e Traumatologia'],
            ['pt_BR' => 'Otorrinolaringologia'],
            ['pt_BR' => 'Patologia'],
            ['pt_BR' => 'Patologia Clínica/ Medicina Laboratorial'],
            ['pt_BR' => 'Pediatria'],
            ['pt_BR' => 'Pneumologia'],
            ['pt_BR' => 'Psiquiatria'],
            ['pt_BR' => 'Radiologia e Diagnóstico por Imagem'],
            ['pt_BR' => 'Radioterapia'],
            ['pt_BR' => 'Reumatologia'],
            ['pt_BR' => 'Urologia']
        ];
        foreach($list as $item){
            $Speciality = new Speciality();
            $Speciality->title = json_encode($item);
            $Speciality->save();
        }
    }
}
