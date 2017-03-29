<?php

namespace App\Http\Controllers;

use App\Services\CicloService;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class CicliController extends Controller
{

    private $ciclo;

    public function __construct(CicloService $ciclo)
    {
        $this->ciclo = $ciclo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = request()->input();
        $data = $this->ciclo->getCicli($parameters);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $ciclo = $this->ciclo->createCiclo();
            return response()->json($ciclo,201);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage(),500]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ciclo->createCicli($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parameters = request()->input();
        $parameters['id'] = $id;
        $data = $this->ciclo->getCicli($parameters);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ciclo->deleteCiclo($id);
    }
}
