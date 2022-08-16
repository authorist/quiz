<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;

class MainController extends Controller
{
    public function dashboard()
     {

          $quizzes = Quiz::where('status','publish')->where(function($query){$query->whereNull('finished_at')->orWhere('finished_at','>',now());})->withCount('questions')->paginate(5);
    //  dd($quizzes);
        $results = auth()->user()->results; //auth helper kullandık şöylede yapabilirdik aynısıdır=> User::with('results');
        return view('dashboard',compact('quizzes','results'));
     }



     public function quiz_detail($slug)
     {

     // return  $quiz = Quiz::whereSlug($slug)->with('my_result','results')->withCount('questions')->first() ?? abort(404,'Quiz bulunamadı');
      //return $quiz = Quiz::whereSlug($slug)->with('my_result','topTen')->withCount('questions')->first() ?? abort(404,'Quiz bulunamadı');
     // return  $quiz = Quiz::whereSlug($slug)->with('my_result', 'topTen.user', 'topTen.quiz')->withCount('questions')->first() ?? abort(404,'Quiz bulunamadı');
          $quiz = Quiz::whereSlug($slug)->with('my_result', 'topTen.user')->withCount('questions')->first() ?? abort(404,'Quiz bulunamadı');
     //dd($quiz);
      return view('quiz_detail',compact('quiz'));
      
     }




     public function quiz($slug)
     {
//'my_result' ı ekledik point verimize quiz_result.blade imizde erişelim diye eklemsemde erişiyor acaba neden ,'my_result' silsen yinede puan verisine ulaşacak çünkü quiz modelimizde my_result metodumuzla ilişki kurulmuş bunu controlerda ekleyip return etmek sadece veriyi oradada(quiz_result.blade) görünmesini  sağlıyor fakat erişiytor bana göre
  //  return $quiz = Quiz::whereSlug($slug)->with('questions.my_answer')->first() ?? abort(404,'Quiz Bulunamadı');
         $quiz = Quiz::whereSlug($slug)->with('questions.my_answer','my_result')->first() ?? abort(404,'Quiz Bulunamadı');

      if($quiz->my_result)
      {
         return view('quiz_result',compact('quiz'));
      }  
      return view('quiz',compact('quiz'));
     }
 




     public function result(Request $request,$slug)
     {

      $quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404,'Quiz Bulunamadı');
         $correct=0;
                  // dd([$quiz,$request->post()]);
                  return $quiz;
               //  return $request->post();
        
  if($quiz->my_result)
  {
      abort(404,'Bu Quiz e daha önce katıldınızııı');
  }


                   foreach($quiz->questions as $question)
                   {
                     // echo $question->id.'- '.$question->correct_answer.'[Y]**[D ]'.$request->post($question->id).'<br>';
                     Answer::create([
                        'user_id'=>auth()->user()->id, // cevaplayacak kişi oturum sahibi olacak
                        'question_id'=>$question->id,
                        'answer'=>$request->post($question->id)
                     ]);
                     //modeliizi oluşturduk Answer tablosuna user_id,question_id,answer kullanıcı degerlerini girdik Answer tablosuna kaydedildi

                        

                     if($question->correct_answer===$request->post($question->id)){
                        $correct+=1;
                     }
                   }

                    $point=round((100/count($quiz->questions))*$correct);
                    $wrong=count($quiz->questions)-$correct;
                 
                   Result::create([
                     'user_id'=>auth()->user()->id,
                     'quiz_id'=>$quiz->id,
                     'point'=>$point,
                     'correct'=>$correct,
                     'wrong'=>$wrong,
                   ]);
                      //print_r($request->post()); 

       return redirect()->route('quiz.detail',$quiz->slug)->withSuccess("Başarıyla Quiz i bitirdin Puanın : ".$point);
     }

}
