<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getBodyPreview()
    {
        return Str::limit($this->body, 250);
    }

    public function createdAtForHumans(){
        //из биб-ки Carbon функция, которая преобразует формат даты.
        return $this->created_at->diffForHumans();
    }

    public function scopeLastLimit($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->limit($numbers)->get();
    }


}
