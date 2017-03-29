<?php

namespace App\Services;

use App\Models\Ciclo;

class CicloService
{

    private $clausuleWhere = [
        'id',
        'nome',
        'data_creazione',
        'obsoleto',
        'data_inizio',
        'data_fine'
    ];

    private $infoSupportate = [
        'titoli' => 'titoli'
    ];

    public function getCicli($parameters)
    {

        $infoAggiuntive = $this->getInformazioniAggiuntive($parameters);
        $clausuleWhere = $this->getClausuleWhere($parameters);

        $cicli = Ciclo::with($infoAggiuntive)->where($clausuleWhere)->get();

        return $this->filtraCicli($cicli, $infoAggiuntive);
    }

    public function createCiclo($request) {

        $ciclo = new Ciclo();

        $ciclo->nome = $request->input('nome');
        $ciclo->data_creazione = date('Y-m-d h:m:s');
        $ciclo->obsoleto = false;
        $ciclo->data_inizio = $request->input('dataInizio');
        $ciclo->data_fine = $request->input('dataFine');

        $ciclo->save();

        return $this->filtraCicli([$ciclo]);

    }

    public function deleteCiclo($id) {
        $ciclo = Ciclo::find($id)->firstOrFail();

        $ciclo->delete();
    }

    private function filtraCicli($cicli, $infoAggiuntive)
    {

        $data = [];

        foreach ($cicli as $ciclo) {
            $item = [
                'nome' => $ciclo->nome,
                'dataInizio' => $ciclo->data_inizio,
                'dataFine' => $ciclo->data_fine
            ];

            if (in_array('titoli', $infoAggiuntive)) {

                foreach ($ciclo->titoli as $titolo) {
                    $item['titoli'][] = [
                        'id' => $titolo->id,
                        'titolo' => $titolo->titolo,
                        'titoloOriginale' => $titolo->titolo_originale,
                        'dataUscita' => $titolo->data_uscita
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