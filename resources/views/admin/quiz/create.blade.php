 
 <x-app-layout>
    <x-slot name="header">Quizler </x-slot>
          

         <!-- hata meşajlarını burada yazdığımız gibi her blade değilde kod tekrarı olmaması için app.blade içinde slotun üsütünde tanımladık  -->
    
    <div class="card">
        <div class="card-body">
            <form action=" {{route('quizzes.store')}} " method="POST" >
             
                @csrf  <!-- csrf yazmasak  form post etmiyecek-->
                <div class="form-group">
                    <label for="">Quiz Başlıgı</label>
                   <input type="text" name="title" class="form-control" value="{{old('title')}}">    <!--reqired etiketini kaldırıdım QuizCreateRequest e title require tqnımladık -->
                </div>
                <div class="form-group">
                    <label for="">Quiz Açılama</label>
                   <textarea name="description" class="form-control" id="" cols="" rows="4"> {{old('description')}}</textarea>
                </div>
 <!-- old(name deki deger yazılır) metodu diyelimki quiz başlığını girdin ama tarihi hatalı girdin validation hatalı döndü hatalı olmayan inputların degerleri kaybolmasın dursun -->



                <div   class="form-group">
                    <input id="isFinished" @if(old('finished_at')) checked @endif type="checkbox" > 
                    <label for="">Bitiş Tarihi Olacak mı</label>
                    
                </div>

                <div id="finishedInput" @if(!old('finished_at')) style="display:none" @endif  class="form-group" >
                    <label for="">Bitiş Tarihi</label>
                    <input  type="datetime-local" name="finished_at" class="form-control" value="{{old('finished_at')}}">
                </div>




                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block form-control" type="submit">Quiz Oluştur </button>
                </div>

            </form>

        </div>
    </div>



    <x-slot name="js">
            <script>
                    // js app.blade in içinde çagırıyoruz
                    //id yakalarken başına haştag atıyorduk input checkboxın id sini yakalayacak
                    $('#isFinished').change(function(){    //isFinished id si change olduğunda şu fonksiyon çalışsın
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