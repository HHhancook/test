<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'statut',
        'user_id',
        'projet_id'
    ];  

    public function projet()
    {
        return $this->belongsTo('App\Models\Projet','projet_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
  
}
