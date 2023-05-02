<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'client',
        'content',
        'url',
        'typology_id'
    ];

    public function typology(){
        return $this->belongsTo(Typology::class); 
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getTechnologyIds()
    {
        return $this->technologies->pluck('id')->all();
    }
}
