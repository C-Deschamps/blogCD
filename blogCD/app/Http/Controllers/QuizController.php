<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\postQuizz;
use Illuminate\Support\Facades\Auth;
use App\quiz;
use App\Possibilites;
use App\User;


class QuizController extends Controller
{
 public function postQuizz(postQuizz $request){
   $inputs = $request->input();
   $nbrQt = $inputs['numberQt'];
   $quizz['name'] = $inputs['title'];
   $quizz['nbrQuestion'] = $nbrQt;
   $user = Auth::user();
   $userId = $user->id;
   $quizz['idUser'] = $userId;
   $create = quiz::create($quizz);
   $create->save();
   $idQuizz = $create['id'];
        // return $inputs;

   for ($i = 1; $i <= $nbrQt; $i++){

      $qt_type = $inputs[$i . 'typeQt'];
      $possibilite['type'] = $qt_type;
      $possibilite['idQuizz'] = $idQuizz;
      $possibilite['title'] = $inputs[$i . 'title'];
      $possibilite['NumQuestion'] = $i;

      if (isset($inputs[$i . 'isPicture'])) {

       $image = $request->file($i . '_image');

       if( !$image->isValid()) {
          return view('admin.createQuizz')->with('error','Désolé mais votre image ne peut pas être envoyée !');
       }
            $chemin = config('pictureQuizz.path');//fais référence au file config/image.php ou on définit le path des image récuperer
                          //pour mon projet ('pictures.path')
            $extension = $image->getClientOriginalExtension();//methode qui recupère l'extension originelle
            do {
              $nom = str_random(10) . '.' . $extension;
            } while(file_exists($chemin . '/' . $nom));//on génére un nom alétoire et on vérifie qu'il n'existe pas déjà

            $cheminPhoto = $chemin . '/' . $nom;

            $image->move($chemin, $nom);
            $possibilite['picture'] = $cheminPhoto;
         }

         // On traite la question en fct de son type
         // Pour le QCM :
         if ($qt_type == 'QCM') {
            $nbPoss = $inputs[$i . 'numberAnswer'];
            $nbResult = $inputs[$i . 'numberRightAnswer'];

            for ($k = 1; $k <= $nbResult; $k++) {
               $result[$k] = $inputs[$i . 'answerRightQcm' . $k];
            }

            for ($j = 1; $j <= $nbPoss; $j++) {
               $possibilite['reponse'] = $inputs[$i . 'answerQcm' . $j];
               if(in_array($j, $result)){
                  $possibilite['isRight'] = 1;
                  $createPoss = Possibilites::create($possibilite);
                  $createPoss->save();

               }
               else{
                  $possibilite['isRight'] = 0;
                  $createPoss = Possibilites::create($possibilite);
                  $createPoss->save();

               }
            }
            unset($possibilite);
         }

         // Pour le Vrai/Faux
         if ($qt_type == 'Bool') {
            $possibilite['reponse'] = $inputs['answerBool' . $i];
            $possibilite['isRight'] = 1;
         }
         //Pour le qt simple
         if ($qt_type == 'Simple') {
          $possibilite['reponse'] = $inputs['answer' . $i];
          $possibilite['isRight'] = 1;
       }
       if ($qt_type != 'QCM') {
         $createPoss = Possibilites::create($possibilite);
         $createPoss->save();
         unset($possibilite);
      }

   }

   return redirect()->action('QuizController@show');
}

   public function show(){
       $quizz = quiz::all();

   foreach ($quizz as $quiz) {
      $userId = $quiz->idUser;
      $user = User::where('id', '=', $userId)->first();
      $userName = $user->name;
      $quiz->autheur = $userName;
   }

   return view('quizz.show', compact('quizz'));
   }


public function showOne($id) {
   $quizz = quiz::where('id', '=', $id)->first();
   $questions = Possibilites::where('idQuizz', '=', $id)->get();
   return $questions;
}

// Fonction qui permet de vérifier si une photo est tjr utilisé et la supprime
public function isUse(){
   $chemin = config('pictureQuizz.path');

}
}
