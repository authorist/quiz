<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model                //questions adındaki tablonun modeli
{
    use HasFactory;

    protected $fillable=[
        
                                'question',
                                'answer1',
                                'answer2',
                                'answer3',
                                'answer4',
                                'correct_answer',
                                'image'
                    
                         ];

      protected $appends=['true_percent'];   //2.harfi büyük harfle başlattığı için arasına alt tire koyması gerekiyor




    public function getTruePercentAttribute()
    {
      
      $answer_count = $this->answers()->count();
       $true_count = $this->answers()->where('answer',$this->correct_answer)->count();
     return round((100/$answer_count)*$true_count);
    }



    public function answers()
    {
      return $this->hasMany('App\Models\Answer');
    }


  public function my_answer()
  {
    return $this->hasOne('App\Models\Answer')->where('user_id',auth()->user()->id);
  }






}
