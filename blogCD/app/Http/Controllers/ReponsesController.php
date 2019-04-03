<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\quiz;
use App\Possibilites;
use App\User;
use App\Reponses;
use Illuminate\Support\Facades\Auth;
use App\scores;
use App\available;

class ReponsesController extends Controller
{
    public function corrigeOne($idQuizz, $numQuestion, $numTentative){
      $user = Auth::user();
      $userId = $user->id;
      $questions = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->get();
      $quizz = quiz::where('id', '=', $idQuizz)->first();
      $reponse = Reponses::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', $numTentative)->where('idUser', '=', $userId)->get();


      return view('quizz.corrigeOne', compact('questions', 'quizz', 'idQuizz', 'numQuestion', 'numTentative', 'reponse'));
    }
}
