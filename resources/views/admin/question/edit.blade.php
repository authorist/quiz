
 <x-app-layout>
    <x-slot name="header">quizID:{{$question->quiz_id}} QuestionID:{{$question->id}} Düzenle (Question) edit.blade </x-slot>

    <div class="card">
        <div class="card-body">
            
              <form action="{{route('questions.update',[$question->quiz_id,$question->id])}}" class="" method="POST" enctype="multipart/form-data">

                @csrf  <!-- csrf yazmasak  form post etmiyecek-->
                @method('PUT')
                <div class="form-group">
                    <label for="">Soru</label>
                    <textarea name="question" class="form-control" id="" cols="" rows="4"> {{$question->question}}</textarea>
                </div>
                <div class="form-group">    
                    <label for="">Fotoğraf</label>
                    @if($question->image)
                    <a href="{{asset($question->image)}}" target="_blank">
                    <img src="{{asset($question->image)}}" alt="" class="img-responsive" style="width:200px;">
                    </a>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">1. Cevap</label>
                        <textarea name="answer1" class="form-control" id="" cols="" rows="2"> {{$question->answer1}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">2. Cevap</label>
                        <textarea name="answer2" class="form-control" id="" cols="" rows="2"> {{$question->answer2}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">3. Cevap</label>
                        <textarea name="answer3" class="form-control" id="" cols="" rows="2"> {{$question->answer3}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">4. Cevap</label>
                        <textarea name="answer4" class="form-control" id="" cols="" rows="2"> {{$question->answer4}}</textarea>
                        </div>
                    </div>
                </div>
                <div   class="form-group">
                    <label for="">Doğru Cevap</label>
                    <select name="correct_answer" id="" class="form-control">
                        <option @if($question->correct_answer==='answer1') selected @endif value="answer1">1. Cevap</option>
                        <option @if($question->correct_answer==='answer2') selected @endif value="answer2">2. Cevap</option>
                        <option @if($question->correct_answer==='answer3') selected @endif value="answer3">3. Cevap</option>
                        <option @if($question->correct_answer==='answer4') selected @endif value="answer4">4. Cevap</option>
                    </select>
                    
                </div>
               
                <div class="form-group mt-2">
                    <button class="btn btn-success btn-sm btn-block form-control" type="submit">Soru Güncelle </button>
                </div>

          </form> 

        </div>
    </div>


    
    <!-- <x-slot name="js">
            <script>
                    //id yakalarken başına haştag atıyorduk input checkboxın id sini yakalayacak
                    $('#isFinished').change(function(){
                        if($('#isFinished').is(':checked'))
                        {
                            $('#finishedInput').show();
                        }
                        else
                        {
                            $('#finishedInput').hide();
                        }
                    })
                </script>   
    </x-slot> -->

</x-app-layout>  