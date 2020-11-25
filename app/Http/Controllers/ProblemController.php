<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Categoria;
use \App\Models\Contact;

class ProblemController extends Controller
{
    public function showCategoria(Categoria $categoria)
    {
        $all = Categoria::all();

        return view('categorias.show-categoria',[
                                                    'selected'=> $categoria,
                                                    'categorias' => $all,
                                                    ]);
    }

    public function sendMessage(Request $request)
    {
        $msg = new Contact;

        $msg->user_id = $request->user_id;
        $msg->name = $request->name;
        $msg->phone = $request->phone;
        $msg->msg = $request->msg;

        $msg->save();

        return redirect()->back()->with('msg',true);
    }
}
