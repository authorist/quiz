
 <x-app-layout>
    <x-slot name="header">{{$quiz->id}}. Quiz Güncelle quiz edit.blade </x-slot>

    <div class="card">
        <div class="card-body">
            <form action=" {{route('quizzes.update',$quiz->id)}} " method="POST" >
                  @csrf   
                 @method('PUT') 
                 
                         <!--   Bu işlemin method put olacak güncelleme için yoksa çalışmaz -->
         <!--   @csrf   csrf yazmasak  form post etmiyecek token gönderiyor   -->
                <div class="form-group">
                    <label for="">Quiz Başlıgı</label>
                   <input type="text" name="title" class="form-control" value="{{$quiz->title}}" >    <!--reqired etiketini kaldırıdım QuizCreateRequest e title require tqnımladık value="{{old('title')}}" kaldırdık bu bilig zaten veritabanından geliyor old ile tutmamnın bir anlamı yok --> 
                </div>                                                       
                <div class="form-group">
                    <label for="">Quiz Açılama</label>
                   <textarea name="description" class="form-control" id="" cols="" rows="4"> {{$quiz->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Quiz Durumu</label>
                   <select name="status" id="" class="form-control">
                        <option @if($quiz->questions_count<4) disabled @endif @if($quiz->status==='publish') selected @endif value="publish">Aktif</option>
                        <option @if($quiz->status==='passive') selected @endif value="passive">Pasif</option>
                        <option @if($quiz->status==='draft') selected @endif value="draft">Taslak</option>
                   </select>
                </div>
                <div   class="form-group">
                    <input id="isFinished" @if($quiz->finished_at) checked @endif type="checkbox" >
                    <label for="">Bitiş Tarihi Olacak mı</label>
                    
                </div>
                <div  @if(!$quiz->finished_at) style="display:none" @endif  class="form-group" id="finishedInput">
                    <label for="">Bitiş Tarihi</label>
                    <input  type="datetime-local" name="finished_at" class="form-control" value="{{$quiz->finished_at}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block form-control" type="submit">Quiz Güncelle </button>
                </div>

            </form>

        </div>
    </div>



    <x-slot name="js">
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
    </x-slot>

</x-app-layout>  