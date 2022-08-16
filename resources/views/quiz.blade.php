
<x-app-layout>
    <x-slot name="header">{{$quiz->title}} ***quiz.blade***</x-slot>


            <div class="card">
                <div class="card-body">                 
                    <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                    @csrf
                    @foreach($quiz->questions as $question)

                    <strong>#{{$loop->iteration}} </strong>{{$question->question}}  

                    @if($question->image)
                    <img src="{{asset($question->image)}}" alt="" class="img-responsive" style="width:50%;">
                    @endif

                    <div class="form-check ">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="bag1" value="answer1" required>
                    <label class="form-check-label" for="bag1">
                    {{$question->answer1}}
                    </label>
                    </div>
                 
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="bag2" value="answer2" required>
                    <label class="form-check-label" for="bag2">
                    {{$question->answer2}}
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="bag3" value="answer3" required>
                    <label class="form-check-label" for="bag3">
                    {{$question->answer3}}
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="bag4" value="answer4" required>
                    <label class="form-check-label" for="bag4">
                    {{$question->answer4}}
                    </label>
                    </div>  
                    <!-- @if(!$loop->last) -->
                    <hr>
                    <!-- @endif --> 
                    @endforeach
                   <div class="d-grid mt-3"> <button type="submit" class="btn btn-success btn-sm btn-block">Sınavı Bitir</button></div>
                    </form>
                  
                
            </div>
            </div>
 
</x-app-layout>









