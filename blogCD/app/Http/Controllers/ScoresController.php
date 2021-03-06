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

class ScoresController extends Controller
{

public function showCorrection($idQuizz, $numTentative, $idUser) {
  $user = Auth::user();
  $idUser = $user->id;
  $userName = $user->name;

  $allRep = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $idUser)->where('numTentative', '=', $numTentative)->orderBy('numQuestion', 'asc')->get();
  $scores = scores::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $idUser)->where('numTentative', '=', $numTentative)->first();

  $allRep = $allRep->unique('numQuestion');
  //Extraction du qcm pour afficher qu'une case et peut etre en orange
  foreach ($allRep as $rep) {
    $green = 'false';
    $red = 'false';
    $orange = 'false';
    if ($rep->idPossibilites != null) { //si c'est une rep du qcm
      $repQcm = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $idUser)->where('numTentative', '=', $numTentative)->where('numQuestion', '=', $rep->numQuestion)->get();
      foreach ($repQcm as $qcm ) {
        if ($qcm->isRight == 1) {
          $green = 'true';
        }
        if ($qcm->isRight == 0) {
          $red = 'true';
        }
        if ($red == 'true' && $green == 'true') {
          $orange = 'true';
        }
      }

      if ($orange == 'true') {
        $rep->isRight = 0.5;
      } elseif ($green == 'true') {
        $rep->isRight  = 1;
      } else {
        $rep->isRight = 0;
      }
    }

  }

  $scoreQuizz = $scores->score;
  $nbrTentative = $scores->numTentative;

  $nbrQst = quiz::where('id', '=', $idQuizz)->first();
  $nbrQst = $nbrQst->nbrQuestion;
// return $allRep;
return view('quizz.correction', compact('scoreQuizz', 'userName', 'nbrTentative', 'nbrQst', 'allRep'));
}
}
