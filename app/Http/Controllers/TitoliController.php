<?php

namespace App\Http\Controllers;

use App\Services\TitoloService;
use Illuminate\Http\Request;

class TitoliController extends Controller
{
    private $titolo;

    public function __construct(TitoloService $titolo)
    {
        $this->titolo = $titolo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = request()->input();
        $data = $this->titolo->getTitoli($parameters);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parameters = request()->input();
        $parameters['id'] = $id;
        $data = $this->titolo->getTitoli($parameters);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $titolo = $this->titolo->updateTitolo($request, $id);
            return response()->json($titolo, 200); // 200 -> ok
        } catch (ModelNotFoundException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage(),500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
