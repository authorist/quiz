<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable=['title','description','finished_at'];  //bunu quiz controllerında store func içinde create request kullandıgımız için bu tanımlamayı yaptık doldurulabilir alanları tanımladık
}
