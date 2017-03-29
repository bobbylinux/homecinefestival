<?php

namespace App\Models;

class Titolo extends BaseModel
{
    protected $table = "titoli";

    public $timestamps = false;

    public function cicli()
    {
        return $this->belongsToMany('App\Models\Titolo','cicli_titoli')->withPivot('obsoleto','data_visualizzazione');
    }
}
