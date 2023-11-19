<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Artist extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'image', 'bio'];

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();
        $logOptions->logName = 'Artists'; // Set the custom log name
        $logOptions->logOnlyDirty = true;
        $logOptions->logAttributes = ['*'];       
        return $logOptions;
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'album_id', 'id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'song_id', 'id');
    }
}
