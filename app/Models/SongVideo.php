<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SongVideo extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();
        $logOptions->logName = 'Song Videos'; // Set the custom log name
        $logOptions->logOnlyDirty = true;
        $logOptions->logAttributes = ['*'];       
        return $logOptions;
    }
//remember to add validation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function song()
    {
        return $this->belongsTo(Song::class, 'song_id','id');
    }

    public function songVideoComments()
    {
        return $this->hasMany(SongVideoComment::class, 'song_video_id', 'id');
    }
}
