<?php

namespace App\Services;

use App\Models\Titolo;

class TitoloService
{

    private $clausuleWhere = [
        'titolo',
        'titoloOriginale',
        'dataUscita'
    ];

    private $infoSupportate = [
        'cicli' => 'cicli'
    ];

    public function getTitoli($parameters) {

        $infoAggiuntive = $this->getInformazioniAggiuntive($parameters);
        $clausuleWhere = $this->getClausuleWhere($parameters);

        $titoli = Titolo::with($infoAggiuntive)->where($clausuleWhere)->get();

        return $this->filtraTitolo($titoli, $infoAggiuntive);
    }

    private function filtraTitolo($titoli, $infoAggiuntive) {

        $data = [];

        foreach ($titoli as $titolo) {
            $item = [
                'titolo' => $titolo->titolo,
                'titoloOriginale' => $titolo->titoloOriginale,
                'dataUscita' => $titolo->data_uscita
            ];

            if (in_array('cicli', $infoAggiuntive)) {

                foreach ($titolo->cicli as $ciclo) {
                    $item['cicli'][] = [
                        'id' => $ciclo->id,
                        'nome' => $ciclo->nome,
                        'dataInizio' => $ciclo->data_inizio,
                        'dataFine' => $ciclo->data_fine
                    ];
                }

            }

            $data[] = $item;
        }

        return $data;

    }

    private function getClausuleWhere($parameters)
    {

        $clause = [];

        foreach ($this->clausuleWhere as $property) {
            if (in_array($property, array_keys($parameters))) {
                $clause[$property] = $parameters[$property];
            }
        }

        return $clause;
    }

    private function getInformazioniAggiuntive($parameters)
    {

        $informazioni = [];

        if (isset($parameters['include'])) {
            $includeParams = explode(',', $parameters['include']);
            $includes = array_intersect($this->infoSupportate, $includeParams);
            $informazioni = array_keys($includes);
        }

        return $informazioni;
    }
}