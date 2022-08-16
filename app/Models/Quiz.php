<?php
//dikkat ettiyeniz namespace dosya yolumuzu içeriyorApp\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;    //kavramını görünce bunun “Eloquent ORM” yapısını olduğunu anlıyoruz.
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;   //eloquent sluggable  kütüphanesi otomatik sluglama sunar


//Not => Laravel’in en güçlü özelliklerinden biri olan Eloquent ORM yapısında veritabanındaki her bir tablo birer model olarak temsil edilir
//NOT :=> Eloquent ORM olayı çıktı. Bu yapı temelini modellerden alır. SQL sorgusu yazmadan veritabanı ile ilişki kurmamıza yardımcı olur
/*NOTuyarısı Laravel Framework ile proje geliştirirlen unutmamamız gereken bir adım olmalı. El altında her zaman açık bir konsol uygulaması bulundurun. 
Bu uygulama CMD, Powershell, Bash gibi herhangi biri olabilir.
NOT  “php artisan” bize Laravel Framework tarafından sunulan tüm konsol işlemlerini çalıştırmamızı sağlar
NOT   Dikkat edilmesi gereken husus şudur. Eloquent ORM yapısı veri girişi veri kaydı veayhutta güncellemesi yaparken tablolarda
 “created_at” ve “updated_at” adında iki sütun ister oluşturur except
*/

class Quiz extends Model               //quizzes adındaki tablonun modeli
{                                  //tablomuzu oluşturan migration dır modelimiz ise oluşan migrationdaki s takısı atılarak model adı verilir yoksa table adını modelde belirtmelisin
    use HasFactory;

    use Sluggable;
    protected $fillable=['title','description','status','finished_at','slug'];  //bunu quiz controllerında store func içinde create request kullandıgımız için bu tanımlamayı yaptık doldurulabilir alanları tanımladık
    
    protected $dates=['finished_at'];  //kendi oluşturdugumuz sütünları bu modelde tanımlıyoruz carbon özelliğini kullanmak için
    
    protected $appends=['details','my_rank'];    //details adında sanal sütün  sanırsam
//bu method sanırsam sanal bir sütün oluşturuyor Details adında ama veritabanında yok get...Attribute() şeklinde nokta yerine sütün adı sanırsam anladıgım
 // tabi bu oluşturmuş oldugumuz sütünü modelimize belirtmemiz gerekiyor   --laravel mutation yapusu bu--- bu method ile datbasede o column olmamasına ragmen verileri quiz sayfasına ekledi
  
    


//NOT =>Modelde böyle Model adı Book ise Books diye tabloyu otomatik bağlar Model adım Book ama tablom yokk Books diye protected $table=tablo_adı diyebilirsin yine
// NOT => Migration Dosyasında Veritabanı Seçme modelde nasılsa migration dada öyle Migration işleminiz, uygulamanızın varsayılan
//        veritabanı bağlantısı dışında bir veritabanı bağlantısıyla etkileşimde bulunacaksa, migration işleminizin $connection 
//         özelliğini ayarlamanız gerekir: örnek protected $connection = 'pgsql'; diye











 
    
    public function getMyRankAttribute()
    {
        $rank=0;
        foreach($this->results()->orderByDesc('point')->get() as $result )
        {
            $rank+=1;
            if(auth()->user()->id == $result->user_id)    //giriş yapan kullanıcının id si result table sunda buluyor kaçıncı sırada diye
                {
                    return $rank;
                }
        }
    }














 public function getDetailsAttribute()
    {


       if($this->results()->count()>0)
       {
         
        return [
            //'average'=>$this->results()->get(),    //get() koymasak results sonuçlarını getirecek get ise result sonuçlarının altında bunuda getir
            'average'=>round($this->results()->avg('point')),  
            'join_count'=>$this->results()->count()
        ];
       }
       return null;
    }









//bu method bir quize ait birden çok kullanıcının sonuçlarını dönder
    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }













//bu method bir quize ait bir kullanıcının sonucunu dönder (puanı)
    public function my_result()
    {
        return $this->hasOne('App\Models\Result')->where('user_id',auth()->user()->id);
    }
   











     public function topTen()
     {
        return $this->results()->orderByDesc('point')->take(10);
     }













     

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date):null;
    }

















    public function questions()
    {
        return $this->hasMany('App\Models\Question'); 
    }













    
//databsedeki sütün yani title column dan alcak slug column ekliyecek
    public function sluggable(): array
    {
        return [
            'slug' => [                 
                'source' => 'title'
                      ]
        ];
    }

}
