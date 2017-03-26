<?php

namespace App\Services;

use App\Models\Titolo;

class TitoloService
{

    public function getTitolo($id) {
        return $this->filterTitolo(Titolo::where('id',$id)->get());
    }

    public function getTitoli() {
        return $this->filterTitolo(Titolo::all());
    }

    private function filterTitolo($titoli) {

        $data = [];

        foreach ($titoli as $titolo) {
            $item = [
                'titolo' => $titolo->titolo,
                'titoloOriginale' => $titolo->titolo_originale,
                'dataUscita' => $titolo->data_uscita
            ];

            $data[] = $item;
        }

        return $data;

    }
}