<?php

namespace App\Models;

class Ciclo extends BaseModel
{

    protected $table = "cicli";

    public $timestamps = false;

    public function titoli()
    {
        return $this->belongsToMany('App\Models\Titolo','cicli_titoli');
    }

}
