<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $timestamps = false;     //yaziyoruz çünkü migration tablomuzdan sildik oluşturmasın diye

    protected $fillable=['user_id','question_id','answer']; 



}
