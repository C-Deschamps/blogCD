<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\sujets;
use App\comments;
use App\User;
use App\Http\Requests\newComment;
use App\Http\Requests\nav;


class CommentsController extends Controller
{

      public function answer($idComment) {
      session_start();

      $text = comments::where('id', '=', $idComment)->first();
      $user = User::where('id', '=', $text->idUser)->first();
      $userName = $user->name;

      $_SESSION['text'] = $userName . " a dit : \n" . $text->text . "\nLe " . $text->created_at . "\n \n";
      $_SESSION['commentAnswer'] = $text->id;
      $idSujet = $text->idSujet;

      return redirect()->action('CommentsController@show', $idSujet);
    }

  // Affiche la premiere page
  public function show($idSujet) {
    session_start();

    $sujet = sujets::where('id', '=', $idSujet)->first();
    $title = $sujet->title; //On a le titre du sujet

    $numPage = 1;
    $nbrMessages = $sujet->nbrMessages;

      $nbrPages = intval(ceil((($nbrMessages)/(10)))); // ceil arrondit au supérieur
      $nbrMessages = sujets::select('nbrMessages')->where('id', '=', $idSujet)->first(); // renvoie un arraye
      $nbrMessages = $nbrMessages->nbrMessages; // on récupere la valeur de la clé "nbrMessages"
      if ($nbrMessages > 10 ) {

        $listComment = comments::where('idSujet', '=', $idSujet)->take(10)->get();
      }

      else {
        $listComment = comments::where('idSujet', '=', $idSujet)->get();
      }

      foreach ($listComment as $comment ) { //On récupere le nom de l'autheur du com
      $comment->auteur = User::select('name')->where('id', '=', $comment->idUser)->first();
      $comment->pdp = User::select('photo')->where('id', '=', $comment->idUser)->first();
      $this->tooLongComment($comment->id);

      if ($comment->reponse != null) {
        $reponse = comments::where('id', '=', $comment->reponse)->first();
        $user = User::where('id', '=', $reponse->idUser)->first();
        $userName = $user->name;
        $comment->answer = $userName . " a dit : \n" . $reponse->text . "\nLe " . $reponse->created_at . "\n";

      }
    }  // permet de gerer la fonction réponse
      if (!isset($_SESSION['text'])) {
      $_SESSION['text'] = null;
      $text = $_SESSION['text'];
      unset($_SESSION['text']);
      unset($_SESSION['commentAnswer']);
      }
      else {
       $text = $_SESSION['text'];

       unset($_SESSION['text']);

        return view('forum.showOne', compact('title', 'sujet', 'listComment', 'text', 'numPage', 'nbrPages','nbrMessages'));
        }
    return view('forum.showOne', compact('title', 'sujet', 'listComment', 'text', 'numPage', 'nbrPages','nbrMessages'));
  }
// Permet d'afficher les pages d'apres
  public function showMore($idSujet, $numPage){
    if ($numPage == 1) { // Si le num de la page est 0 alors on utilise la fonction show
      return redirect()->action('CommentsController@show', $idSujet);
    }
    session_start();

      $sujet = sujets::where('id', '=', $idSujet)->first();
      $title = $sujet->title; //On a le titre du sujet

      $text = null;

      $nbrMessages = sujets::select('nbrMessages')->where('id', '=', $idSujet)->first(); // renvoie un arraye
      $nbrMessages = $nbrMessages->nbrMessages; // on récupere la valeur de la clé "nbrMessages"
      $nbrPages = intval(ceil((($nbrMessages)/(10))));
      $nbrSkip = $numPage - 1;
      $nbrCommentSkip = $nbrSkip * 10; //On calcul le nbr de comment a skip

      $listComment = comments::where('idSujet', '=', $idSujet)->skip($nbrCommentSkip)->take(10)->get();


    foreach ($listComment as $comment ) { //On récupere le nom de l'autheur du com
      $this->tooLongComment($comment->id);
      $comment->pdp = User::select('photo')->where('id', '=', $comment->idUser)->first();
      $comment->auteur = User::select('name')->where('id', '=', $comment->idUser)->first();

      if ($comment->reponse != null) { // on créer la reponse en italique
        $reponse = comments::where('id', '=', $comment->reponse)->first();
        $user = User::where('id', '=', $reponse->idUser)->first();
        $userName = $user->name;
        $comment->answer = $userName . " a dit : \n" . $reponse->text . "\nLe " . $reponse->created_at . "\n";

      }
    }

      // permet de gerer la fonction réponse
        if (!isset($_SESSION['text'])) {
      $_SESSION['text'] = null;
      $text = $_SESSION['text'];
      unset($_SESSION['text']);
      }
      else {
       $text = $_SESSION['text'];
       unset($_SESSION['text']);

        return view('forum.showOne', compact('title', 'sujet', 'listComment', 'numPage', 'text', 'nbrPages','nbrMessages'));
        }
      return view('forum.showOne', compact('title', 'sujet', 'listComment', 'numPage', 'text', 'nbrPages','nbrMessages'));
    }


    public function newCommentPost(newComment $request, $idSujet){
      session_start();

      $newComment = $request->input();


      $sujet = sujets::where('id', '=', $idSujet)->first();


      $user = Auth::user();
      $userId = $user->id;

      $newComment['idUser'] = $userId;
      $newComment['idSujet'] = $idSujet;


      if (isset($_SESSION['commentAnswer'])) { //Le comment est une réponse
          $reponse = comments::where('id', '=', $_SESSION['commentAnswer'])->first();
          $newComment['reponse'] = $reponse->id;
        }
      $addComment = comments::create($newComment);
      $addComment->save();
      $nbrMsg = sujets::where('id', '=', $idSujet)->increment('nbrMessages');
      $nbrMessages = $sujet->nbrMessages;

      if ($nbrMessages > 10) { //On check le nbr de msg du sujet pour rediriger vers a bonnes pages apres avoir posté le comment
        $numPage = intval(ceil((($nbrMessages)/(10)))); //ceil permet d'arrondir au supérieur

        return redirect()->action('CommentsController@showMore', [$idSujet, $numPage]);
      }

      return redirect()->action('CommentsController@show', $idSujet);
    }

    public function tooLongComment($idComment){
      $comment = comments::where('id', '=', $idComment)->first();
      $textComment = $comment->text;

      $lines_arr = preg_split('/\n/',$textComment); //la fonction preg_split permet de split un text (donc une string) en plusieur bout avec un délimiteur (ici \n)
      $num_newlines = count($lines_arr);

      //Si la première ligne fait plus de 160 cara (2 ligne sur le site)
      if (strlen($lines_arr[0]) > 160) {
        $strFirst = $lines_arr[0];
        $firstLine = substr($strFirst, -156);
        $update = comments::where('id', '=', $idComment)->update(['debut' => $firstLine]);

      }
      //ou plus de 2 lignes
      else if ($num_newlines > 2) {
        $debut = $lines_arr[0] . $lines_arr[1];
        $update = comments::where('id', '=', $idComment)->update(['debut' => $debut]);
      }

    }
       public function navPost(nav $request, $idSujet) {

      $inputs = $request->input();
       $numPage = $inputs['numNav'];
       return redirect()->action('CommentsController@showMore', [$idSujet, $numPage]);

    }

  }
