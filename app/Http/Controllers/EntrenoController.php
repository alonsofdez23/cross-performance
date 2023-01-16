<?php

namespace App\Http\Controllers;

use App\Models\Entreno;
use Illuminate\Http\Request;

class EntrenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('entrenos.index', [
            'entrenos' => Entreno::all()->sortBy('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entrenos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entreno = new Entreno($request->all());
        $entreno->save();

        return redirect()->route('entrenos.index')
            ->with('success', "Entreno $entreno->denominacion creado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreno  $entreno
     * @return \Illuminate\Http\Response
     */
    public function show(Entreno $entreno)
    {
        return view('entrenos.show', [
            'entreno' => $entreno,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entreno  $entreno
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreno $entreno)
    {
        return view('entrenos.edit', [
            'entreno' => $entreno,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entreno  $entreno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entreno $entreno)
    {
        $entreno->fill($request->all());
        $entreno->save();

        return redirect()->route('entrenos.index')
            ->with('success', "Entreno $entreno->denominacion editado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreno  $entreno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreno $entreno)
    {
        if ($entreno->clases->isNotEmpty()) {
            return redirect()->route('entrenos.index')
                ->with('error', "Entreno $entreno->denominacion asignado a clase. No puede borrarse");
        } else {
            $entreno->delete();

            return redirect()->route('entrenos.index')
                ->with('success', "Entreno $entreno->denominacion borrado correctamente");
        }
    }
}
