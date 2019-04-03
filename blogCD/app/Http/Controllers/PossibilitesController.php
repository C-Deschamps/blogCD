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

class PossibilitesController extends Controller
{
 public function postQt(Request $request, $idQuizz, $numQuestion) {
   $inputs = $request->all();
   $final = 'false';
   $forceCorrec = 0;

      $question = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->first();
      $user = Auth::user();
      $userId = $user->id;
      if ($request->submitbutton == 'nextQt') {
         $numNext = $numQuestion + 1;
      }
      elseif ($request->submitbutton == 'prevQt') {
         $numNext = $numQuestion - 1;
      }
      elseif ($request->submitbutton == 'final') { //Fonction qui détermine ce que fait le user après avoir finit le quizz
         $numNext = $numQuestion;
         $final = 'true';
      }
      else {
         $numNext = $numQuestion;
      }
      // return $inputs;
      unset($inputs['_token']); //on enleve le token et la valeur du submit button
      unset($inputs['submitbutton']);
      if (!isset($inputs['reponseSimple'])) { //si le reponse = null on le supprime
          unset($inputs['reponseSimple']);
      }
      $reponse['idUser'] = $userId;
      $reponse['numQuestion'] = $numQuestion;
      $reponse['idQuizz'] = $idQuizz;

      $arrayKey = array_keys($inputs); //On récupère les keys de inputs, ce qui correspond aux id des possibilités choisis

      $isReponse = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', null)->get();

      $array_vide = array();

      if ($inputs != $array_vide) { //on verifie si le user à rentrer de nvelles données
        //Si il existe deja une réponse

       if (isset($isReponse[0]) ) { //Fonction qui va update les réponse déja existantes

         if ($question->type == 'QCM'){ //Pour un qcm, on supprime les reponses existantes pour enregistrer les nouvelles
            $delete = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->delete();
            $nbArray = count(array_keys($inputs));
            for ($i = 0 ; $i < $nbArray; $i++) {
               $isRight = PossibilitesController::isRight($idQuizz, $numQuestion, $arrayKey[$i]);
               $reponse['isRight'] = $isRight;
               $reponse['idPossibilites'] = $arrayKey[$i];
               $create = Reponses::create($reponse);
               $create->save();
            }

         }

         if ($question->type == 'Bool') {
            $isRight = PossibilitesController::isRight($idQuizz, $numQuestion, $inputs[$arrayKey[0]]);

            $update = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', null)->update(['reponseSimple' => $inputs[$arrayKey[0]], 'isRight' => $isRight]);

         }
         if ($question->type == 'Simple') {

            $isRight = PossibilitesController::isRight($idQuizz, $numQuestion, $inputs[$arrayKey[0]]);

            $update = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', null)->update(['reponseSimple' => $inputs[$arrayKey[0]], 'isRight' => $isRight]);

         }


            if ($final == 'true') { //SI c'est la dernière question alors on valide et corrige le quizz
      return redirect()->action('PossibilitesController@correction', [$idQuizz, $forceCorrec]);
   }
         return redirect()->action('QuizController@showOne', [$idQuizz, $numNext]);
   }
    else { //si il nya pas de rep existante

 if ($question->type == 'QCM'){
        $nbArray = count(array_keys($inputs));

        for ($i = 0 ; $i < $nbArray; $i++) {
         $reponse['idPossibilites'] = $arrayKey[$i];
         $isRight = PossibilitesController::isRight($idQuizz, $numQuestion, $arrayKey[$i]);
         $reponse['isRight'] = $isRight;
         $create = Reponses::create($reponse);
         $create->save();
      }
   }
   if ($question->type == 'Bool') {
      $reponse['reponseSimple'] = $inputs[$arrayKey[0]]; //On recup la première ligne de input
     $isRight = PossibilitesController::isRight($idQuizz, $numQuestion, $inputs[$arrayKey[0]]);

       $reponse['isRight'] = $isRight;
      $create = Reponses::create($reponse);
      $create->save();
   }
   if ($question->type == 'Simple') {
      $reponse['reponseSimple'] = $inputs[$arrayKey[0]];
      $isRight = PossibilitesController::isRight($idQuizz, $numQuestion, $inputs[$arrayKey[0]]);
      $reponse['isRight'] = $isRight;

      $create = Reponses::create($reponse);
      $create->save();
   }

   if ($final == 'true') { //SI c'est la dernière question alors on valide et corrige le quizz
      return redirect()->action('PossibilitesController@correction', [$idQuizz, $forceCorrec]);
   }

   return redirect()->action('QuizController@showOne', [$idQuizz, $numNext]);

   }
  }

 else {  // Si le inputs est vide

$reponse['isRight'] = 0;
   $repExist = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where([
         ['idPossibilites', '=', null],
         ['reponseSimple', '=', null],
         ['numTentative', '=', null],
      ])->get();

   if (!isset($repExist[0])) { //si ya deja une rep vide pour cette question
    $create = Reponses::create($reponse);
    $create->save();
   }
   if ($final == 'true') {
    return redirect()->action('PossibilitesController@correction', [$idQuizz, $forceCorrec]);
   }

     return redirect()->action('QuizController@showOne', [$idQuizz, $numNext]);
}

}

public function correction($idQuizz, $forceCorrec) {
      $user = Auth::user();
      $userId = $user->id;
      $userName = $user->name;
      $scoreQuizz = 0;
      $question = array();
      $n = 0;



      $poss = Possibilites::where('idQuizz', '=', $idQuizz)->where('type', '=', 'QCM')->where('isRight', '=', 1)->orderBy('NumQuestion', 'asc')->get();
       foreach ($poss as $pos) { //On détermine le nombre de reponse juste par qcm
           if ($pos->type == 'QCM') {
            if(isset($question[$pos->NumQuestion])){ //utilisation de isset pour eviter le undifined variable
               $question[$pos->NumQuestion] = $question[$pos->NumQuestion] + 1 ;
            } else {
               $question[$pos->NumQuestion] = 1;
            }
           }
        }
        if ($forceCorrec == 0) { //SI le user n'a pas forcer la correction

        $qstNoFait = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numTentative', '=', null)->where([
         ['idPossibilites', '=', null],
         ['reponseSimple', '=', null],
      ])->orderBy('numQuestion', 'asc')->get(); //query qui recupère les reponse qui n'ont pas de rep

        $qstNoFait = $qstNoFait->unique('numQuestion'); //enleve les doublons

       if ($qstNoFait != '[]'){
          foreach ($qstNoFait as $qst) {
          $listNoRep[$n] = $qst->numQuestion; //array qui contient le num des question pas fait
          $n ++;
       }

       return view('quizz.nonTraite', compact('listNoRep', 'idQuizz'));
       }
       }


      $scores = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('isRight', '=', 1)->where('numTentative', '=', null)->orderBy('numQuestion', 'asc')->get();

      foreach ($scores as $score) {
         if (in_array($score->numQuestion, array_keys($question))) { //Si le num question est contenue dans la varible alors la question est un QCM
            if(isset($qcm[$score->numQuestion])){ //utilisation de isset pour eviter le undifined variable
               $qcm[$score->numQuestion] = $qcm[$score->numQuestion] + 1 ;
            } else {
               $qcm[$score->numQuestion] = 1;
            }
         }
         else {
            $scoreQuizz ++; //Pour les autres type sa augment juste le score de +1
         }
      }
      if (isset($qcm)) {
      foreach ($qcm as $key => $value) {
         $numQuestion = $key;
         $repRight = $value;
         $totRepJuste = $question[$key];
         $isWrong = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', null)->where('isRight', '=', 0)->get();
         $isRight = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', null)->where('isRight', '=', 1)->get();
         if ($isWrong == null) {
            if ($repRight == $totRepJuste){
               $scoreQuizz ++;
            }
            else {
               $scoreQuizz += 0.5;
            }

         }
          else {
            $scoreQuizz += 0.5;
         }
      }
     }
      $scoreFinal['idUser'] = $userId;
      $scoreFinal['idQuizz'] = $idQuizz;
      $scoreFinal['score'] = $scoreQuizz;


      //update du nombre de tentative
      $nbrTent = scores::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->orderBy('numTentative', 'dsc')->first();

      if ($nbrTent != null) {
         $nbrTentative = $nbrTent->numTentative;

         $nbrTentative ++;

      } else {
         $nbrTentative = 1;

      }

      $scoreFinal['numTentative'] = $nbrTentative;
      $create = scores::create($scoreFinal);
      $create->save();



      $repUpdate = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', null)->update(['numTentative' => $nbrTentative]);

      //Passage du quizz en unavailable
      $isAvailable = available::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->first();
      if ($isAvailable != null) {
         $avaible = available::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->update(['available' => 0]);
      } else {
         $available['available'] = 0;
         $available['idQuizz'] = $idQuizz;
         $available['idUser'] = $userId;
         $create = available::create($available);
      }




      return redirect()->action('PossibilitesController@showCorrection', $idQuizz);

}

public function showCorrection($idQuizz) {
  $user = Auth::user();
  $userId = $user->id;
  $userName = $user->name;

  $maxTent = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->orderBy('numTentative', 'dsc')->first();
  $maxTent = $maxTent->numTentative;

  $allRep = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', $maxTent)->get();
  $scores = scores::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', $maxTent)->first();

  $scoreQuizz = $scores->score;
  $nbrTentative = $scores->numTentative;

  $nbrQst = quiz::where('id', '=', $idQuizz)->first();
  $nbrQst = $nbrQst->nbrQuestion;

return view('quizz.correction', compact('scoreQuizz', 'userName', 'nbrTentative', 'nbrQst', 'allRep'));
}

public function isRight($idQuizz, $numQuestion, $reponse) { //Fonction qui va comparer le résultatUser avec le bon résultat
   $poss = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('isRight', '=', 1)->get();
   if ($poss[0]->type == 'QCM') {

   $idRight = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('isRight', '=', 1)->pluck('id'); //on récupère les id des réponses justes
   $idRight = json_decode($idRight);
   $intReponse = (int)($reponse);


      if (in_array($intReponse, $idRight)) {//on regarde si la réponseUser est contenu dans le tableau des réponse
         return 1;
      } else {
         return 0;
      }

   }
   else {
      $reponseSimple = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('isRight', '=', 1)->pluck('reponse');

      if ($reponse == $reponseSimple[0]) {
         return 1;
      } else {
         return 0;
      }
   }
}
}
