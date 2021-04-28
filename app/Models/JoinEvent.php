<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user','id_event','name_leader', 'name_member',
        'contact_leader', 'schema', 'note'
      ];

      public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    public function event(){
        return $this->hasOne(Event::class, 'id', 'id_event');
    }

}
