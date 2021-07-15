<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','img','slug'];

    public $dates = ['published_at'];

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
        return $this->published_at->diffForHumans();
        //из биб-ки Carbon функция, которая преобразует формат даты.
        //return $this->created_at->diffForHumans();
    }

    public function scopeLastLimit($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->limit($numbers)->get();
    }

    public function scopeAllPaginate($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->paginate($numbers);
    }

    public function scopeFindBySlug($query, $slug)
    {
        return $query->with('comments','tags', 'state')->where('slug', $slug)->firstOrFail();
    }

    public function scopeFindByTag($query)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->paginate(10);
    }


}
