<x-app-layout>
    <x-slot name="header">Anasayfa </x-slot>
    <div class="container-fluid">
      <div class="alert alert-danger"> Bootstrap Alert mesajı dashboard.blade</div>


        <div class="row">
          <div class="col-md-8">

                <div class="list-group">
                  @foreach($quizzes as $quiz)
                    <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$quiz->title}}</h5>
                        <small>{{$quiz->finished_at ? $quiz->finished_at->diffForHumans().' bitiyor...' : null }}</small>
                      </div>
                      <p class="mb-1">{{Str::limit($quiz->description,100)}}</p>
                      <div class="d-flex w-100 justify-content-between">
                          <small>{{$quiz->questions_count}} Soru</small>    
                          <small>
                          @if($quiz->my_result)
                                 <span class="badge bg-warning rounded-pill">Quiz çözdünüz</span>
                                  @elseif($quiz->finished_at>now())
                                  <span class="badge bg-primary rounded-pill">Quiz katılmadınız</span>
                            @endif
                            </small> 
                      </div>               
                    </a>
                    @endforeach
                    <div class="mt-2">
                    {{$quizzes->links()}}
                    </div>
                  </div>

          </div><!--  end of col-md-8 -->

          <div class="col-md-4">
                <div class="card"">
                   <div class="card-header">
                             Quiz Sonuçları
                        </div>
                        @foreach($results as $result)
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>{{$result->point}}</strong> - 
                        <a href="{{route('quiz.detail',$result->quiz->slug)}}">{{$result->quiz->title}}</a>

                    </li>
                  </ul>
                  @endforeach
                   </div>
          </div><!--  end of col-md-4 -->


        </div> <!--  end of Row -->
     </div> <!--  end of container -->


 

  
</x-app-layout>
