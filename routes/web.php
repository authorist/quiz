<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth', // 'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/panel', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::group(['middleware'=>'auth'],function() {
    Route::get('panel',[MainController::class,'dashboard'])->name('dashboard');  //isAdmin middleware yönlendiriyor dashboarda
    Route::get('quiz/detay/{slug}',[MainController::class,'quiz_detail'])->name('quiz.detail');
    Route::get('quiz/{slug}',[MainController::class,'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result',[MainController::class,'result'])->name('quiz.result');

});



Route::group(['middleware'=>['auth','isAdmin'],'prefix'=>'admin'],function(){

    //ilk önce destroy metodu aşagıya alırsan show methoda gider
    //çünkü Route::resource da show metodu form istegimiz metodu put olduğu için onu ilk önce çagırır ilk önce onu çagırmaması için Route::resource dan önce destroy tanımlamamız gerek tanımladık yine problem creta metodunu url ile çakışıyor create url i quizzes\create destroy webroute url ise quizzes\{id} onuda şöyle çözebiliriz
    //şimdi webroute quizzes\create giriyorsa create string bir deger o zaman biz webroute destroy a  diyecez ki {id} olan yere create yazılmıssa bu bir string biz tamsayı degeri olanı
    //alıp webroute girip destroy metodun u çagiracagız onun için wherenumber('id') ise destroy webroute  umuza gir tamsayı degilse istek aşagıdaki route yönelir 
            Route::get('quizzes/{id}',[QuizController::class,'destroy'])->whereNumber('id')->name('quizzes.destroy'); 

            Route::get('quizzes/{id}/details',[QuizController::class,'show'])->whereNumber('id')->name('quizzes.details'); 
            Route::get('quiz/{quiz_id}/questions/{id}',[QuestionController::class,'destroy'])->whereNumber('id')->name('questions.destroy'); 

            Route::resource('quizzes',QuizController::class);      
            Route::resource('quiz/{quiz_id}/questions',QuestionController::class); 
            //'quiz/{quiz_id}/questions' url deki bu uzun tanım şu şekilde slash dan sonra son veriyi alır yani 'questions' diye geçer olur
            //ayrıca route  question index e gitse bile route a $quiz->id bildirilmeli 
              //  Route::get('deneme',function()  {
                //    return "prefix testi";
     });

 
