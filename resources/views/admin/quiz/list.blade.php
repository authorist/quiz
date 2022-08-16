<x-app-layout>

    <x-slot name="header">
        Quizler 
    </x-slot>

  
  
  <div class="card">

    <div class="card-header text-center text-muted">
        Featured quiz list.blade
    </div>

    <div class="card-body">
       





                                <!-- float-right kabul etmiyor onun için text-right yaptım oldu -->
         <h5 class="card-title text-right">
            <a href="{{route('quizzes.create')}}" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i>  Quiz oluştur</a>
        </h5>





        
        <form action="" method="GET">
            <div class="container-fluid">
            <div class="row mb-3">
                <div class="form-group col-md-2">                       <!--   //post işlemi yaptiğında palceholderdaki veri yazılıyordu hemen bir value degeri oluşturdu post işlemi gerçekleştiğinde post verisinde gönderdiğimiz title degerini yaz -->
                    <input class="form-control" type="text" name="title" value="{{request()->get('title')}}" placeholder="Quiz adı" >
                </div>

                <div class="form-group col-md-2">
                   <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="">Durum Seçiniz</option>
                        <option @if(request()->get('status')=='publish') selected @endif value="publish">Aktif</option>
                        <option @if(request()->get('status')=='passive') selected @endif value="passive">Pasif</option>
                        <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak</option>
                   </select>
                </div>

                @if(request()->get('title') || request()->get('status'))
                <div class="col-md-2">
                    <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Sıfırla</a>
                </div>
                @endif
            </div>
            </div>
        </form>
      
        





        
                   <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Quiz</th>
                        <th scope="col">Soru Sayısı</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizzes as $quiz)
                        <tr>
                        <td>{{$quiz->title}}</td>
                         <td>{{$quiz->questions_count}}</td>           
                        <td style="text-align:center" >
                            @switch($quiz->status)
                                @case('publish')
                                @if(!$quiz->finished_at)
                                <button type="button" class="btn btn-success " >Aktif</button>
                                @elseif($quiz->finished_at>now())
                                <button type="button" class="btn btn-success " >Aktif</button>
                                @else
                                <button type="button" class="btn btn-secondary text-white " >Süresi Dolmuş</button>   
                                @endif
                                @break
                                @case('draft')
                                <button type="button" class="btn btn-warning" >Taslak</button>
                                @break
                                @case('passive')
                                <button type="button" class="btn btn-danger" >Pasif</button>
                                @break
                            @endswitch
                                              <!-- diffforrhumans=>carbon paketler create_at ve updated_at fonksiyonları için tanımlanmış ama bizim oluşturduğumuz sütünlar için oluşturmaz onun için model-->                         
                        </td>


                        <td> 
                             <span title="{{$quiz->finished_at}}">
                                   {{$quiz->finished_at ? $quiz->finished_at->diffforHumans() : '-' }}
                             </span>
                        </td> 
                        <td>
                            <a href="{{route('quizzes.details',$quiz->id)}}" class="btn btn-secondary btn-sm" ><i class="fa fa-info-circle"></i></a>
                            <a href="{{route('questions.index',$quiz->id,$quiz->question_count)}}" class="btn btn-warning btn-sm" ><i class="fa fa-question"></i></a>
                            <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-primary btn-sm" ><i class="fa fa-pen"></i></a>
                            <a href="{{route('quizzes.destroy',$quiz->id)}} " class="btn btn-danger btn-sm" ><i class="fa fa-times"></i></a>
                        </td>
                        </tr>
                        @endforeach  
                    </tbody>                    
                    </table>
                    {{$quizzes->withQueryString()->links()}} 
                    <!-- $quizzes->links() bize sayfalar arası geçiş olan sayfanın altında onu yapıor  -->
                    <!-- withQueryString() ise sayfalar arsı geçişte url deki veriyi silme o sorguyla devam et  -->
    
    
    
    
      </div><!-- card-body-div-END -->

            <div class="card-footer text-muted text-center">
                Cooperation
            </div><!-- card-footer-div-END -->

  </div> <!-- card-div-END -->

  
  
</x-app-layout>
