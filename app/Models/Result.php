<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    

    protected $fillable=['user_id','quiz_id','point','correct','wrong'];


    public function user()
    {
        //User tablomuza ait bilgileri Result tablosuna getir veya göster bu ilişki migrationlarda oluşturduğumuz primary key ilişkisi degil sadece tablonun verilerine ulaşıyor belongsTo() metodu ile.
        return $this->belongsTo('App\Models\User');  
    }
    public function quiz()  
    {
        
        return $this->belongsTo('App\Models\Quiz');  
    }

    // public function quiz()
    // {
    //    
    //     return $this->belongsTo('App\Models\Quiz');  
    // }

    
}
