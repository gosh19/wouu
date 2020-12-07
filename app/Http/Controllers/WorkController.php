<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Work;
use App\Models\Postulation;

class WorkController extends Controller
{
    public function index()
    {
        $worksPendientes = Work::where('state','pendiente')->orderBy('updated_at','desc')->get();

        return view('works.index',['works'=>$worksPendientes]);
    }

    public function showWork(Work $work)
    {
        return view('works.show-work',['work'=>$work]);
    }

    public function postulate(Work $work, Request $request)
    {
        $postulation = new Postulation;

        $postulation->user_id = Auth::id();
        $postulation->work_id = $work->id;
        $postulation->msg = $request->msg;
        $postulation->presupuesto = $request->presupuesto;

        $postulation->save();

        return redirect()->back();
    }

    public function acceptTecno(\App\Models\Postulation $postulation, Work $work)
    {
        $work->tecnico = $postulation->user_id;
        $work->state = "in_process";
        $work->save();

        $postulation->state = 'selected';
        $postulation->save();

        return redirect()->back();
    }
}
