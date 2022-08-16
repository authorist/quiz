
<x-app-layout>
    <x-slot name="header">{{$quiz->title}}     quiz show.blade sayfası</x-slot>


            <div class="card">
                <div class="card-body">  
                    <p class="card-text">

                    <h5 class="card-title">
                      <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-left"></i>  Quizlere Dön  </a>
                    </h5>





                        <div class="row">
                            <div class="col-md-4">
                            <ul class="list-group">
                              @if($quiz->my_rank)                              
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                              Sıralamanız
                                   <span class="badge bg-primary rounded-pill">{{$quiz->my_rank}}. sıradasınız</span>
                              </li>
                              @endif
            @if($quiz->my_result)
            <li class="list-group-item d-flex justify-content-between align-items-center">
            Puan
            <span class="badge bg-primary rounded-pill">{{$quiz->my_result->point}}</span>
            </li>
            

              <li class="list-group-item d-flex justify-content-between align-items-center">
              Doğru / Yanlış Sayısı
              <div class="float-right">
              <span class="badge bg-success rounded-pill">{{$quiz->my_result->correct}} Doğru</span>
              <span class="badge bg-danger rounded-pill">{{$quiz->my_result->wrong}} Yanlış</span>
              </div>
              </li>
            @endif
    @if($quiz->finished_at)
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Son Katılım Tarihi
    <span title="{{$quiz->finished_at}}" class="badge bg-primary rounded-pill">{{$quiz->finished_at->diffForHumans()}} bitiyor</span>
  </li>
  @endif

  <li class="list-group-item d-flex justify-content-between align-items-center">
    Soru Sayısı
    <span class="badge bg-primary rounded-pill">{{$quiz->questions_count}}</span>
  </li>

        @if($quiz->details)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Katılımcı Sayısı
              <span class="badge bg-primary rounded-pill">{{$quiz->details['join_count']}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Ortalama Puan
              <span class="badge bg-primary rounded-pill">{{$quiz->details['average']}}</span>
            </li>
        @endif
</ul>

              @if(count($quiz->topTen)>0)
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">
                          İlk 10
                        </h5>
                        <ul class="list-group">
                            @foreach($quiz->topTen as $result)
                            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                                 <strong >{{$loop->iteration}}.</strong>
                                 <img class="w-8 h-8 rounded-full" src="{{$result->user->profile_photo_url}}" alt="">
                                 <span @if(auth()->user()->id == $result->user_id) class="text-success" @endif > {{$result->user->name}} </span>
                                 <span class="badge bg-primary rounded-pill">{{$result->point}}</span>   
                             </li>
                            @endforeach
                        </ul>
                      </div>
                    </div>
                @endif

         </div><!--end of col-md-4 -->
                            <div class="col-md-8">
                           {{$quiz->description}}</p>
                           <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                    <th scope="col">Ad Soyad </th>
                                    <th scope="col">Puan</th>
                                    <th scope="col">Doğru</th>
                                    <th scope="col">Yanlış</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quiz->results as $result)
                                    <tr>
                                    <td>{{$result->user->name}}</td>
                                    <td>{{$result->point}}</td>
                                    <td>{{$result->correct}}</td>
                                    <td>{{$result->wrong}}</td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                            
                            </div><!--end of col-md-8 -->
          </div>  <!--end of Row -->
                
            </div><!--end of card-body -->
            </div><!--end of Card -->
 
</x-app-layout>









