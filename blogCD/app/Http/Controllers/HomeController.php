<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\quiz;
use App\Possibilites;
use App\Reponses;
use Illuminate\Support\Facades\Auth;
use App\scores;
use App\available;
use App\comments;
use App\sujets;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showUserInfo($idUser) {
        $user = Auth::user();
      $userId = $user->id;
        //Verification que le user demandé correspond au user en coure
        // if ($isUser == $userId){} ->orderBy('updated_at', 'desc')
        $userInfo = User::where('id', '=', $idUser)->first();
        $lastScores = scores::where('idUser', '=', $idUser)->orderBy('updated_at', 'desc')->take(3)->get();
        foreach ($lastScores as $score) {
            $nomQuizz = quiz::where('id', $score->idQuizz)->first();
            $score->nomQuizz = $nomQuizz->name;
            $score->nbrQuestion = $nomQuizz->nbrQuestion;
        }

        $lastComment = comments::where('idUser', $idUser)->orderBy('updated_at', 'desc')->take(3)->get();
        foreach ($lastComment as $com) {
            $sujet = sujets::where('id', $com->idSujet)->first();
            $com->nomSujet = $sujet->title;
            //Determination du num de page
            $i = $sujet->nbrMessages;
            $i = (int)($i/10);
            for ($j = 0; $j <= $i; $j++){
                $listComment = comments::where('idSujet', $com->idSujet)->orderBy('updated_at', 'asc')->skip($j * 10)->take(10)->pluck('id'); //On recupe les 10 com par page
                $listComment = $listComment->toArray();
                if (in_array($com->id, $listComment)){ //On regarde si le com qu'on a est contenu dans cette page grace aux id
                    $com->numPage = $j + 1;
                }

            }

        }


        $nbrCommentaire = comments::where('idUser', $idUser)->get();
        $nbrCommentaire = count($nbrCommentaire);

        $nbrQuizzFini = scores::where('idUser', '=', $idUser)->get();
        $nbrQuizzFini = count($nbrQuizzFini->unique('idQuizz'));

        $nbrTentative = scores::where('idUser', '=', $idUser)->get();
        $nbrTentative = count($nbrTentative);
        return view('UserInfo.show', compact('userInfo', 'lastScores', 'nbrCommentaire', 'nbrQuizzFini', 'nbrTentative', 'lastComment'));
    }
}
