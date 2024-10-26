<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    //tambahkan ini agar bisa melakuakn mess assignment
    protected $guarded = [];

    public function user(){ // buatkan relasi antara article dan model user
        // return $this->belongsTo(User,"foreign_key","other_key");
        return $this->belongsTo(User::class);
    }

    //sampai sini
}
