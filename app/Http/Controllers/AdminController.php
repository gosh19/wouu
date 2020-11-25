<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use \App\Models\TecnoData;

class AdminController extends Controller
{
    public function createCategoria(Request $request)
    {
        $categoria = new Categoria;

        $categoria->name = $request->name;

        $categoria->save();

        return redirect()->back();
    }

    public function deleteCategoria(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->back();
    }

    public function index()
    {
        $categorias = Categoria::all();
        $tecnosPendientes = TecnoData::where('approved',0)->get();

        return view('admin.index',[
                                    'categorias' => $categorias,
                                    'tecnoPendientes' => $tecnosPendientes
                                    ]);
    }

    public function editApproved(TecnoData $tecno, $approved)
    {
        if ($approved) {
            $tecno->approved = $approved;
    
            $tecno->save();
        }else{
            $tecno->delete();
        }
        


        return redirect()->back();
    }
}
