<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;


    protected $fillable = [
        'caption',
        'info',
        'category_id'
    ];
    
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function getImagePathAttribute()
    {
        return 'articles/' . $this->attachments[0]->name;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getImagePathsAttribute()
    {
        $paths = [];
        foreach ($this->attachments as $attachment) {
            $paths[] = 'articles/' . $attachment->name;
        }
        return $paths;
    }

    public function getImageUrlsAttribute()
    {
        $urls = [];
        foreach ($this->image_paths as $path) {
            $urls[] = Storage::url($path);
        }
        return $urls;

        // return Storage::url($this->image_path);
    }
}
