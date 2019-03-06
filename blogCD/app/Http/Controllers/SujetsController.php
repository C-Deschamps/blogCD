<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sujets;
use App\Http\Requests\newSujet;
use App\User;
use Illuminate\Support\Facades\Auth;


class SujetsController extends Controller
{
    public function post(newSujet $request) {
      $inputs = $request->input();
      $user = Auth::user();
      $userId = $user->id;
      $inputs["idUser"] = $userId;
      $inputs["nbrMessages"] = 0;

      $newSujet = new sujets();
      $newSujet = sujets::create($inputs);

      return redirect()->action('SujetsController@show');
    }


    public function show() {
      $i = 0;
      $j = 0;
      $listSujet = sujets::all();

      foreach ($listSujet as $sujet) {

       $idUser = $sujet->idUser;
        $name[$i] = User::select('name')->where('id', '=', $idUser)->first();

        $i++;
      }


      return view('forum.home', compact('listSujet', 'name', 'j'));
    }


 }
