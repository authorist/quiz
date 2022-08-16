
<x-app-layout>
    <x-slot name="header">{{$quiz->title}} ***quiz.result.blade***</x-slot>


            <div class="card">
                <div class="card-body">  
    <div class="d-flex justify-content-between align-items-center">                
            <h3>Puan : <strong>{{$quiz->my_result->point}}</strong></h3>
            <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm" ><i class="fa fa-arrow-left"></i>  Panele Dön  </a>
    </div>
                <div class="alert alert-danger">
                <i class="fa fa-circle-xmark"></i>İşaretlediğin Cevap<br>
                <i class="fa fa-check text-success"></i>Doğru Cevap<br>
                <i class="fa fa-times text-danger"></i>Yanlış Cevap<br> 
                </div>
                    
                   
                    @foreach($quiz->questions as $question)
                <small>Bu soruya katılımcıların %{{$question->true_percent}} i dogru cevap verdi</small><br>
                            @if($question->correct_answer == $question->my_answer->answer)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-times text-danger"></i>
                            @endif

                    <strong>#{{$loop->iteration}} </strong>{{$question->question}}  

                    @if($question->image)
                    <img src="{{asset($question->image)}}" alt="" class="img-responsive" style="width:50%;">
                    @endif

                    <div class="form-check ">
                    @if($question->correct_answer=='answer1')
                    <i class="fa fa-check text-success"></i>
                    @elseif($question->my_answer->answer=='answer1')
                    <i class="fa fa-circle-xmark"></i>
                    @endif
                    <label class="form-check-label" for="bag1">
                    {{$question->answer1}}
                    </label>
                    </div>
                    <div class="form-check">
                    @if($question->correct_answer=='answer2')
                    <i class="fa fa-check text-success"></i>
                    @elseif($question->my_answer->answer=='answer2')
                    <i class="fa fa-circle-xmark"></i>
                    @endif
                    <label class="form-check-label" for="bag2">
                    {{$question->answer2}}
                    </label>
                    </div>
                    <div class="form-check">
                    @if($question->correct_answer=='answer3')
                    <i class="fa fa-check text-success"></i>
                    @elseif($question->my_answer->answer=='answer3')
                    <i class="fa fa-circle-xmark"></i>
                    @endif
                    <label class="form-check-label" for="bag3">
                    {{$question->answer3}} 
                    </label>
                    </div>
                    <div class="form-check">
                    @if($question->correct_answer=='answer4')
                    <i class="fa fa-check text-success"></i>
                    @elseif($question->my_answer->answer=='answer4')
                    <i class="fa fa-circle-xmark"></i>
                    @endif
                    <label class="form-check-label" for="bag4">
                    {{$question->answer4}}
                    </label>
                    </div>  
                    <!-- @if(!$loop->last) -->
                    <hr>
                    <!-- @endif --> 
                    @endforeach
                 
                  
                
            </div>
            </div>
 
</x-app-layout>









