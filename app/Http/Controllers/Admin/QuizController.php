<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;  //oluşturmuş oldugumuz QuizCreateRequest i controllerımızda yolu belirtiyoruz çagırıyoruz
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes=Quiz::paginate(5); // $quizzes=Quiz::get(); dersek veritabandaki hepsini gönderir paginate istege göre
        return view('admin.quiz.list',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        //funtion store() ->yeni sayfanın veritabanına yazılmasını kontrol eden fonksiyon       // $quiz = new Quiz;
        // $quiz->title= request->title;
        // $quiz->save();
        // daha önce böyle yapıyordu dahA kısası var

        Quiz::create($request->post());  //bu post türü ile model klasörüde Quiz.php store() fillable ekledik

         return redirect()->route('quizzes.index')->withSuccess('Quiz başarıyla oluşturuldu.');
       // return $request->post(); 
       //post olan tüm datayı gönder demek
    }

    /**
     * Display the specified resource.
      *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return "show metodu";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $quiz = Quiz::find($id) ?? abort(404,'Quiz Bulunamadı');  //burda güncellenecek id yakalıyor artık quiz ait bilgiler edit sayfasına gider
        // dd($quiz);    //db içersinde veriyi gösteririr içeriği yani attributesleri ayrıca id yoksa null döner null dönmesin hata dönsün onuda ??sora belirtebiliriz

         return view('admin.quiz.edit',compact('quiz')); //admin.quiz.edit edit sayfasına yönlendiriyor edit yerine update yazsakda olur
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404,'Quiz Bulunamadı'); //udate ediyoruz ama veri var mı yokmu id sinden kontrol ediyoruz 
        
       // Quiz :: where('id',$id)->update($request->post()); //store func oldugu gibi komple post ediyoruz bu şekilde token veriside giderbu alana ait sütünumuz yok onu güncellemeyecegiz onun için onları excep ile kaldıracaguız
       Quiz :: where('id',$id)->update($request->except(['_method','_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quiz güncelleme işlemi başarıyla gerçekleşti'); //index sayfasını aç şu meşajı ver diyor
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $quiz = Quiz::find($id) ?? abort (404,'Quiz Bulunamadı');
         $quiz->delete();
       return redirect()->route('quizzes.index')->withSuccess('Quiz silme işlemi başarıyla gerçekleşti');
    }
}
