<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Song extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'year',
        'featuring',
        'produced_by',
        'written_by',
        'image',
        'about',
        'music_video',
        'artist_id',
        'album_id',
    ];

    protected $hidden = [              
        'created_at',
        'updated_at',
        'deleted_at',
        'artist_id',
        'album_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();
        $logOptions->logName = 'Songs'; // Set the custom log name
        $logOptions->logOnlyDirty = true;
        $logOptions->logAttributes = ['*'];       
        return $logOptions;
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    public function songVideos()
    {
        return $this->hasMany(SongVideo::class);
    }

    //not sure about this
    public function users()
    {
        return $this->belongsToMany(User::class, 'song_videos');
    }
}
