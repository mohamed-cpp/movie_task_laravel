<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\Filesystem;


class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'rate',
        'image',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function setImageAttribute($file)
    {
        if ($file instanceof UploadedFile) {
            $file->move($this->photoPath(),$imageName = $file->hashName());
            (new Filesystem())->delete($this->photoPath($this->image));
            $this->attributes['image'] = $imageName;
        }
    }


    public function photoPath( $name = null){
        return storage_path("app/public/movie/images/$name");
    }

    /**
     * @return string
     */
    public function photoUrl(){
        return $this->image ? asset("storage/movie/images/{$this->image}") :
            asset("/assets/images/image.png");
    }

}
