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
            'Acupuntura',
            'Alergia e Imunologia',
            'Anestesiologia',
            'Angiologia',
            'Cardiologia',
            'Cirurgia Cardiovascular',
            'Cirurgia da Mão',
            'Cirurgia de Cabeça e Pescoço',
            'Cirurgia do Aparelho Digestivo',
            'Cirurgia Geral',
            'Cirurgia Oncológica',
            'Cirurgia Pediátrica',
            'Cirurgia Plástica',
            'Cirurgia Torácica',
            'Cirurgia Vascular',
            'Clínica Médica',
            'Coloproctologia',
            'Dermatologia',
            'Endocrinologia e Metabologia',
            'Endoscopia',
            'Gastroenterologia',
            'Genética Médica',
            'Geriatria',
            'Ginecologia e Obstetrícia',
            'Hematologia e Hemoterapia',
            'Homeopatia',
            'Infectologia',
            'Mastologia',
            'Medicina de Emergência',
            'Medicina de Família e Comunidade',
            'Medicina do Trabalho',
            'Medicina de Tráfego',
            'Medicina Esportiva',
            'Medicina Física e Reabilitação',
            'Medicina Intensiva',
            'Medicina Legal e Perícia Médica',
            'Medicina Nuclear',
            'Medicina Preventiva e Social',
            'Nefrologia',
            'Neurocirurgia',
            'Neurologia',
            'Nutricionista',
            'Nutrologia',
            'Oftalmologia',
            'Oncologia Clínica',
            'Ortopedia e Traumatologia',
            'Otorrinolaringologia',
            'Patologia',
            'Patologia Clínica/ Medicina Laboratorial',
            'Pediatria',
            'Pneumologia',
            'Psiquiatria',
            'Radiologia e Diagnóstico por Imagem',
            'Radioterapia',
            'Reumatologia',
            'Urologia'
        ];
        foreach($list as $item){
            $Speciality = new Speciality();
            $Speciality->title = json_encode(['pt_BR' => $item]);
            $Speciality->save();
        }
    }
}
