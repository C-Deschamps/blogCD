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
      $noRepQcm = 'false';
      $questions = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->get();
      $quizz = quiz::where('id', '=', $idQuizz)->first();
      $reponse = Reponses::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', $numTentative)->where('idUser', '=', $userId)->get();
      if ($questions[0]->type == 'QCM') { //traitement spécial
         if ($reponse[0]->idPossibilites == null) { // S'il n'y a pas de réponse
            $noRepQcm = 'true';
         }
      }
      $allQuestions = Possibilites::where('idQuizz', '=', $idQuizz)->get();
    $allQuestions = $allQuestions->unique('NumQuestion');
    $allQuestionsArray = $allQuestions->toArray();
    $allCount = count($allQuestionsArray);

    $reponsesFaux = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', $numTentative)->where('isRight', '=', 0)->get();
     $reponsesFaux = $reponsesFaux->unique('numQuestion');
     $reponsesJusteA = $reponsesFaux->toArray();
     $i = 0;
     foreach ($reponsesFaux as $rep) {
       $repFaux[$i] = Possibilites::where('idQuizz', '=', $idQuizz)->where('NumQuestion', '=', $rep->numQuestion)->first();
       $i ++;
            }

    $reponsesJusteList = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', $numTentative)->where('isRight', '=', 1)->pluck('numQuestion');

    $reponsesJuste = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', $numTentative)->where('isRight', '=', 1)->get();
     $reponsesJuste = $reponsesJuste->unique('numQuestion');
     $reponsesJusteA = $reponsesJuste->toArray();
     $reponsesJusteList = $reponsesJusteList->toArray();

      $j = 0;
     foreach ($reponsesJuste as $rep) {
       $repJuste[$j] = Possibilites::where('idQuizz', '=', $idQuizz)->where('NumQuestion', '=', $rep->numQuestion)->first();
       $j ++;
            }


     $justeCount = count($reponsesJusteA);

     $fauxCount = $allCount - $justeCount;



      return view('quizz.corrigeOne', compact('questions', 'quizz', 'idQuizz', 'numQuestion', 'numTentative', 'reponse', 'noRepQcm', 'allCount', 'allQuestions', 'fauxCount', 'justeCount', 'repJuste', 'repFaux', 'reponsesJusteList'));
    }
}
