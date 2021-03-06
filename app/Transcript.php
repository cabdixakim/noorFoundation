<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Transcript extends Model implements HasMedia
{
    use InteractsWithMedia;
    //
    protected $fillable = [
         
         'description',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);

    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('transcript')
        ->singleFile();
            //add options
        
            
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(150)
              ->height(150)
              ->sharpen(10)
              ->nonQueued();
    }

}
