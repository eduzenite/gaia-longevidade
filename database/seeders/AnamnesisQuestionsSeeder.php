<?php

namespace Database\Seeders;

use App\Models\AnamnesisAnswers;
use App\Models\AnamnesisQuestions;
use Illuminate\Database\Seeder;

class AnamnesisQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'type' => 2,
                'language' => ['pt_BR' => 'Caso clínico'],
            ],
            [
                'type' => 5,
                'language' => ['pt_BR' => 'Possui alguma restrição alimentar?'],
                'options' => ['pt_BR' => ['Não', 'Vegetariano', 'Vegano']]
            ],
            [
                'type' => 5,
                'language' => ['pt_BR' => 'Ingere bebida alcoólica?'],
                'options' => ['pt_BR' => ['Não', 'Todos os dias', 'Finais de semana', 'Socialmente']]
            ],
            [
                'type' => 2,
                'language' => ['pt_BR' => 'Qual tipo de bebida e quanto?'],
                'category' => 3
            ],
            [
                'type' => 5,
                'language' => ['pt_BR' => 'Fuma?'],
                'options' => ['pt_BR' => ['Não', 'Todos os dias', 'Finais de semana', 'Socialmente']]
            ],
            [
                'type' => 2,
                'language' => ['pt_BR' => 'Quantidade de cigarros'],
                'category' => 5
            ],
            [
                'type' => 4,
                'language' => ['pt_BR' => 'Patologias'],
                'options' => ['pt_BR' => ['Ansiedade', 'Câncer', 'Cardíaco', 'Circulatório', 'Colite', 'Depressão', 'Diabetes', 'Dislipidemia', 'Dor de cabeça', 'Endócrino', 'Gastrite', 'Irritabilidade', 'Herpes', 'Hepatite', 'Hipertireoidismo', 'Hipotireoidismo', 'Hipoglicemia', 'Hipertensão', 'Osteoporose', 'Renal', 'Rinite/Sinusite', 'RGE']]
            ],
        ];
        foreach($list as $item){
            $AnamnesisQuestions = new AnamnesisQuestions();
            if(isset($item['category'])){
                $AnamnesisQuestions->anamnesis_question_id = $item['category'];
            }
            $AnamnesisQuestions->type = json_encode($item['type']);
            $AnamnesisQuestions->question = json_encode($item['language']);
            $AnamnesisQuestions->save();
            if(isset($item['options'])){
                $AnamnesisAnswers = new AnamnesisAnswers();
                $AnamnesisAnswers->anamnesis_question_id = $AnamnesisQuestions->id;
                $AnamnesisAnswers->answers = json_encode($item['options']);
                $AnamnesisAnswers->save();
            }
        }
    }
}
