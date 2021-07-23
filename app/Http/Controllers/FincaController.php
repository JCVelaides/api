<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finca;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\JwtMiddleware;

class FincaController extends Controller
{
    /*public function index(Request $request)
    {

        $finca = Finca::orderBy('id', 'DESC')->get();
        return $finca;
    }*/

    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function index(Request $request)
    {
        $finca = Finca::where('id_usuario', auth()->user()->id)->where('estado', 0)->orderBy('id', 'DESC')->get();
        return response()->json(['finca' => $finca, 'nombre' => auth()->user()->name]);
    }

    public function crearFinca(Request $request)
    {
        $finca = new Finca(request()->all());
        $finca->nombreFinca = $request->nombreFinca;
        $finca->procedencia = $request->procedencia;
        $finca->departamento = $request->departamento;
        $finca->estado = 0;
        $aux = $request->verificado;
        if($aux != 0)
        {
            $finca->verificado = $request->verificado;
            $finca->fechaVerificado = $request->fechaVerificado;
            $finca->nombreVerificado = $request->nombreVerificado;
            $finca->observacionVerificado = $request->observacionVerificado;
        }
        $finca->id_usuario = auth()->user()->id;
        $finca->save();
        return response()->json(auth()->user(), 200);
    }

    public function editarFinca(Request $request, $id)
    {
        $finca = Finca::find($id)->update($request->all());
        return;
    }

    public function destroy(Request $request, $id)
    {
        /*Finca::find($id)->update([
            'estado' => 1
        ]);*/
        $finca = Finca::find($id)->update($request->all());
        return;
    }

}
