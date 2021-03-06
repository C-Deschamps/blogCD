<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\postQuizz;
use Illuminate\Support\Facades\Auth;
use App\quiz;
use App\Possibilites;
use App\User;
use App\Reponses;
use App\available;
use DB;

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
   $available['idQuizz'] = $idQuizz;

   $availableCreate = available::create($available);
   $availableCreate->save();
   for ($i = 1; $i <= $nbrQt; $i++){

    $qt_type = $inputs[$i . 'typeQt'];
    $possibilite['type'] = $qt_type;
    $possibilite['idQuizz'] = $idQuizz;
    $possibilite['title'] = $inputs[$i . 'title'];
    $possibilite['NumQuestion'] = $i;

    if(isset($inputs['description' . $i])) { //si ya une description
      $possibilite['description'] = $inputs['description' . $i];
    }

    if (isset($inputs[$i . 'isPicture'])) { //si il ya une image

     $image = $request->file($i . '_image');

     if( !in_array($image->getClientOriginalExtension(), array('png', 'jpeg', 'jpg'))) {
      return view('admin.createQuizz')->with('error','Désolé mais votre image ne peut pas être envoyée !');
    }
            $chemin = config('pictureQuizz.path');//fais référence au file config/image.php ou on définit le path des image récuperer


            $temp = 'temp/';
            $extension = $image->getClientOriginalExtension();//methode qui recupère l'extension originelle

            $tempNom ='tmp' . '.' . $extension;


            do {
              $nom = str_random(10) . '.' . $extension;
            } while(file_exists($chemin . '/' . $nom));//on génére un nom alétoire et on vérifie qu'il n'existe pas déjà
            $tempChemin = $temp . '/' . $tempNom;
            $cheminPhoto = $chemin . '/' . $nom;
            $image->move($chemin, $nom);
            //$image->move($temp, $tempNom); //On place l'image dans un dossier temporaire
            //$imageGD = $this->resize_image($tempChemin, 800, 400); // On rezise la photo avec la fonction ecrit plus haut
            //imagejpeg($imageGD, $cheminPhoto); // imageGD est donnée sous la forme d'une ressorce GD (la librairie utilisé)
            //unlink($tempChemin); //On suprime la photo temporaire
                          //pour mon projet ('pictures.path')
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
//affiche le tableau des quizz
   public function show(){
    //recup les tentative à null et les supprimes
    $deleteNull = Reponses::where('numTentative', null)->delete();
     $quizz = quiz::all();
     $user = Auth::user();
     $currentUserid = $user->id;

     foreach ($quizz as $quiz) {
      $userId = $quiz->idUser;
      $user = User::where('id', '=', $userId)->first();
      $userName = $user->name;
      $quiz->autheur = $userName;

      //Fct qui regarde si le quizz est dispo
      $available = available::where('idQuizz', '=', $quiz->id)->where('idUser', '=', null)->first();
      $userAvailable = available::where('idQuizz', '=', $quiz->id)->where('idUser', '=', $currentUserid)->first();

      if ($available->available == 1) {
        $quiz->available = 'true';
        if ($userAvailable != null && $userAvailable->available == 0) {
          $quiz->available = 'user_down';
        }
      }
      else {
        $quiz->available = 'admin_down';
      }


    }


    return view('quizz.show', compact('quizz'));
  }


//affiche une question du quizz
  public function showOne($idQuizz, $numQuestion) {
    session_start();

    $quizz = quiz::where('id', '=', $idQuizz)->first();
    $questions = Possibilites::where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->get();
    $picture = array();
    $user = Auth::user();
    $userId = $user->id;

   // Pour la sidebar
    $isAnswer = 'true';
    $isNoAnswer = 'true';
    $allQuestions = Possibilites::where('idQuizz', '=', $idQuizz)->get();
    $allQuestions = $allQuestions->unique('NumQuestion');
    $allQuestionsArray = $allQuestions->toArray();
    $allCount = count($allQuestionsArray);

  $allQuestionsRepArray = Reponses::where('idQuizz', '=', $idQuizz)->where('idUser', '=', $userId)->where('numTentative', '=', null)->where(function ($q) {
    $q->where('reponseSimple', '!=', null)->orWhere('idPossibilites', '!=', null); //utilisation de fct dans un where pour utiliser le orWhere parafitement
  })->orderBy('numQuestion', 'asc')->pluck('numQuestion'); //recup les reponse qui ont été entré
 $allQuestionsRepArray;
    $allQuestionsRepArray = $allQuestionsRepArray->toArray();//transformation en array ...
    $allQuestionsRepArray = array_unique($allQuestionsRepArray); //... permet d'utiliser cette fct


    if (!empty($allQuestionsRepArray)) { //SI le user a deja repondu a des questions

      $allQuestionsNoRepArray = DB::table('Possibilites')->where('idQuizz', '=', $idQuizz)->whereNotIn('NumQuestion', $allQuestionsRepArray)->orderBy('numQuestion', 'asc')->pluck('NumQuestion');
      $allQuestionsNoRepArray = $allQuestionsNoRepArray->toArray();

      if (!empty($allQuestionsNoRepArray)) { //si le user n'as pas répondu a toute les questions

    $allQuestionsNoRepArray = array_unique($allQuestionsNoRepArray);

        $r = 0;
        foreach ($allQuestionsNoRepArray as $noRep) {
          $allQuestionsNoRep[$r] = DB::table('Possibilites')->where('idQuizz', '=', $idQuizz)->where('NumQuestion', '=', $noRep)->first();
          $r ++;
        }


    $n = 0;
    foreach ($allQuestionsRepArray as $rep) {
      $allQuestionsRep[$n] = Possibilites::where('idQuizz', '=', $idQuizz)->where('NumQuestion', '=', $rep)->first();
      $n ++;
    }

    $repCount = count($allQuestionsRepArray);
    $noRepCount = count($allQuestionsNoRepArray);

  } else {
   $allQuestionsRep = $allQuestions;
    $repCount = $allCount;
   $allQuestionsNoRep = '[]';
   $noRepCount = 0;
   $isNoAnswer = 'false';

 }

} else {
  $allQuestionsNoRep = $allQuestions;
  $noRepCount = $allCount;
  $allQuestionsRep = '[]';
  $repCount = 0;
  $isAnswer = 'false';
}

// On check si le user a deja répondu ou pas a cette question
  $reponse = Reponses::where('idUser', '=', $userId)->where('idQuizz', '=', $idQuizz)->where('numQuestion', '=', $numQuestion)->where('numTentative', '=', null)->get();
  $i = 0;
  $repQCM = array();
  foreach ($reponse as $rep) {
    $repQCM[$i] = $rep->idPossibilites;
    $i++;
  }
   //$picture ="'" . $questions[0]->picture . "'";

$picture = $questions[0]->picture;
return view('quizz.showOne', compact('questions', 'quizz', 'reponse', 'repQCM', 'picture', 'allQuestions', 'allQuestionsRep', 'allQuestionsNoRep', 'isAnswer', 'isNoAnswer', 'noRepCount', 'allCount', 'repCount'));
}

// Fonction qui permet de vérifier si une photo est tjr utilisé et la supprime sinon
public function isUse(){
 $chemin = config('pictureQuizz.path');

}

public function newTentative($idQuizz) {
  session_start();

  $_SESSION['newTentative'] = 0;
  return redirect()->action('QuizController@showOne', [$idQuizz, '1']);
}

public function resize_image($file, $w, $h, $crop=FALSE) {
  list($width, $height) = getimagesize($file);
  $r = $width / $height;
  if ($crop) {
    if ($width > $height) {
      $width = ceil($width-($width*abs($r-$w/$h)));
    } else {
      $height = ceil($height-($height*abs($r-$w/$h)));
    }
    $newwidth = $w;
    $newheight = $h;
  } else {
    if ($w/$h > $r) {
      $newwidth = $h*$r;
      $newheight = $h;
    } else {
      $newheight = $w/$r;
      $newwidth = $w;
    }
  }
  $src = imagecreatefromjpeg($file);
  $dst = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

  return $dst;
}


}
