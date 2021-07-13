<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','img','slug'];

    //данная модель может иметь много комментариев один ко многим связь
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    //взаимоотношения статистики один к одному
    public function state(){
        return $this->hasOne(State::class);
    }
    //взаимоотношения к тэгам многие ко многим
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
