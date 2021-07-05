<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];

    protected $fillable = [
        'title', 'description', 'content', 'image', 'category_id', 'user_id', 'published_at'
    ];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tag_id)
    {
        return in_array($tag_id, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');
        
        return $search
            ? $query->published()->where('title', 'LIKE', "%{$search}%")
            : $query->published();
    }
}
