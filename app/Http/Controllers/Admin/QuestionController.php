<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuestionCreateRequest;
use Illuminate\Support\Str;              
 //use Illuminate\Support\Str;   =>slug
use App\Http\Requests\QuestionUpdateRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
      // return Quiz::find($id); demek Quiz id si bu olanı getir 
       //return Quiz::find($id)->questions; demek  Quiz id si bu olanla ilgili tüm soruları  getir questions a ilişki kurduk artık quiz modelimin üzerinden erişebilirim
        
        $quiz= Quiz::withCount('questions')->whereId($id)->with('questions')->first() ?? abort(404,'Quiz Bulunamadı.');
        return view('admin.question.list',compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz= Quiz::find($id);
       return view('admin.question.create',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request ,$id)
    {

            if($request->hasFile('image'))        // resim soyası geldimi var mı
            {
                $fileName = Str::slug($request->question).'.'.$request->image->extension();   //question adını kaydediyoruz boşluk varsa slug ile sorunsuz aıyor yukarıya str kütüphanesini ekledi
               //return $filename;
                $fileNameWithUpload = 'uploads/'.$fileName;   //resmin yolu
                //kaydetme işlemi
                $request->image->move(public_path('uploads/'),$fileName); //bu public-uploads klasörü içine filename adında kaydet projeye
             //   $request->image = $fileNameWithUpload; //burdada projedeki image dosyamızi database e kaydetiyor // image null kaydetti onun yerine merge yazacagız
                    $request->merge([
                        'image'=>$fileNameWithUpload
                    ]);  
            }


         Quiz::find($id)->questions()->create($request->post());  //Quiz::find($id)->questions()->create($request->all());  database de uzantıyı tp olarak kaydettiği için all yerine post yazdı ya da merge attirubute all adilmiyordur post ediliyuordur
         return redirect()->route('questions.index',$id)->withSuccess('Soru başarıyla oluşturuldu');
         // return Quiz::find($id)->questions;
        // return Quiz::find($id);
        // return $id;
        //  return $request->post();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id,$question_id)
    {
        $question= Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404,'Quiz veya Soru bulunamadı');

        return view('admin.question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id,$question_id)
    {
        if($request->hasFile('image'))        // resim dosyası geldimi var mı
            {
                $fileName = Str::slug($request->question).'.'.$request->image->extension();   //question adını kaydediyoruz boşluk varsa slug ile sorunsuz aıyor yukarıya str kütüphanesini ekledi
                
                $fileNameWithUpload = 'uploads/'.$fileName;  
                $request->image->move(public_path('uploads/'),$fileName); //bu public-uploads klasörü içine filename adında kaydet projeye
             //   $request->image = $fileNameWithUpload; //burdada projedeki image dosyamızi database e kaydetiyor // image null kaydetti onun yerine merge yazacagız
                    $request->merge([
                        'image'=>$fileNameWithUpload
                    ]);  
            }


         Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post());  //Quiz::find($id)->questions()->create($request->all());  database de uzantıyı tp olarak kaydettiği için all yerine post yazdı
         return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru başarıyla güncellendii');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id,$question_id)
    {
        Quiz::find($quiz_id)->questions()->whereId($question_id)->delete();
        return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru başarıyla silindi.');
    }
}
