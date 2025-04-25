<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
    //Relacion muchos a muchos con Tag
    public function tags(){
        return $this->belongsToMany(Tag::class,'tag_task','id_tag','id_task');
    }

}
