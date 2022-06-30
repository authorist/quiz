<?php

namespace Database\Factories;
use App\Models\Quiz;                 /* *bu satır yoktu ben ekledim */
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QuizFactory extends Factory
{

                                    
    protected $model = Quiz::class;  /**bu satır yoktu ben ekledim */ 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
             //   'title'=>'Quiz Başlğı' 
             //dersek her seed işleminde veri oluşturdugumda tabloma
             // hepsinin adını aynı yapacak 100 lerce 1000 lerce veri lazım bunun için tasarlanmış
             // kütphane var (faker)
             'title'=>$this->faker->sentence(rand(3,7)),
             'description'=>$this->faker->text(200)
        ];
    }
}
