<x-app-layout>
    <x-slot name="header">ID : {{$quiz->id}} olan Quiz e ait Sorular (Question) list.blade </x-slot>

  
  
  <div class="card">
    <div class="card-body">
        <h5 class="card-title float-right">
            <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i>  Soru  oluştur  </a>
        </h5>
        <h5 class="card-title">
            <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-left"></i>  Quizlere Dön  </a>
        </h5>
                            <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                        <th scope="col"><span class="badge bg-primary rounded-pill">{{$quiz->questions_count}}</span>  Soru </th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1. Cevap</th>
                        <th scope="col">2. Cevap</th>
                        <th scope="col">3. Cevap</th>
                        <th scope="col">4. Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col" style="width :100px;">İşlemler</th>   
                        </tr>
                        @foreach($quiz->questions as $question)
                        <tr>
                        <td>{{$question->question}}</td>
                        <td>
                          @if($question->image)
                          <a href="{{asset($question->image)}}" class="btn btn-sm btn-warning" target="_blank" >Görüntüle</a>
                          @endif
                        </td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td class="text-success">{{substr($question->correct_answer,-1)}}. Cevap</td> 
                        <td>
                          <!-- substr php kodudur sondaki harfi yakalar --> 
                           
                            <a href="{{route('questions.edit',[$quiz->id,$question->id])}}" class="btn btn-primary btn-sm" ><i class="fa fa-pen"></i></a>
                            <a href=" {{route('questions.destroy',[$quiz->id,$question->id])}} " class="btn btn-danger btn-sm" ><i class="fa fa-times"></i></a>
                        </td>
                        </tr>
                        @endforeach  
                    </thead>
                    <tbody>
                      
                    </tbody>
                    </table>
                    
                    <!-- $quizzes->links() bize sayfalar arası geçiş olan sayfanın altında onu yapıor  -->
    </div>
  </div>

  

</x-app-layout>
