<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstituicao;
use App\Http\Requests\StoreRequest;
use App\Models\Instituicao;
use Illuminate\Support\Facades\Validator;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicaos = Instituicao::all();
        return response()->json(['data' => $instituicaos ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstituicao $request)
    {
        try {
            $instituicao = Instituicao::create($request->all());

            $path = $request->file('image')->store(
                'images/'.$instituicao->id, 'public'
            );
            $instituicao->images()->create([
                'path' => $path,
                'nome' => $instituicao->nome,
            ]);

            return response()->json(['data' => ['Criado com sucesso', $instituicao, $path] ]);

        } catch (\Throwable $th) {
            return response()->json(['data' => $th->getMessage() ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instituicao = Instituicao::find($id);
        return response()->json(['data' => $instituicao ]);
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
        //
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