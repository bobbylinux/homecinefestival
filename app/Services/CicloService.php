<?php

namespace App\Services;

use App\Models\Ciclo;

class CicloService
{

    public function getCiclo($id) {
        return $this->filtraCicli(Ciclo::where('id',$id)->get());
    }

    public function getCicli() {
        return $this->filtraCicli(Ciclo::all());
    }

    protected function filtraCicli($cicli) {

        $data = [];

        foreach ($cicli as $ciclo) {
            $item = [
                'nome' => $ciclo->nome,
                'dataInizio' => $ciclo->data_inizio,
                'dataFine' => $ciclo->data_fine
            ];

            $data[] = $item;
        }

        return $data;
    }
}