<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(User $user = null)
    {
        if ($user == null) {
            $user = Auth::user();
        }
        $categorias = \App\Models\Categoria::all();

        return view('user.index',[
                                    'user'=> $user,
                                    'categorias' => $categorias,
                                    ]);
    }

    public function postulacionTecnico(User $user, \App\Models\Categoria $categoria)
    {   
        $tecnoData = \App\Models\TecnoData::firstOrCreate(['user_id'=> $user->id,'categoria_id'=> $categoria->id]);

        return redirect()->back();
    }

    public function editUserData(User $user, Request $request)
    {
        $userData = \App\Models\UserData::firstOrNew(['user_id'=>$user->id]);

        $userData->dni = $request->dni;
        $userData->adress = $request->adress;
        $userData->city = $request->city;
        $userData->barrio = $request->barrio;
        $userData->province = $request->province;
        $userData->phone = $request->phone;
        $userData->phone_alt = $request->phone_alt;

        $userData->save();

        return redirect()->back();
    }
}
