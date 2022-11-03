<?php

namespace App\Models;

use App\Tools\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 'slug', 'body', 'image_path', 'approved', 'category_id', 'user_id'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //************** */ Models Scope ****************//
    public function scopeApproved($query)
    {
        return $query->whereapproved(true)->latest();
    }
    //************** Eloquent: Mutators & Casting Accessors  ****************//
    public function getImagepathattribute($img)
    {
        return asset('storage/images/' . $img);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Slug::uniqueSlug($value, 'posts');
    }

    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title']= $value;
    //     $this->attributes['slug']= Slug::uniqueSlug($value,'posts');
    // }

}
