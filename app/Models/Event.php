<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_user',
      'name',
      'cost',
      'description',
      'category',
      'location',
      'benefits',
      'poster_event',
      'requirements',
      'organizer',
      'contact_organizer',
      'status',
      'time_start',
      'time_reglimit'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function getPicturePathAttribute(){
        return config('app.url') . Storage::url($this->attributes['poster_event']);
    }

}
