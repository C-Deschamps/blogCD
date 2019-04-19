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

        $nbrCommentaire = comments::where('idUser', $idUser)->get();
        $nbrCommentaire = count($nbrCommentaire);

        $nbrQuizzFini = scores::where('idUser', '=', $idUser)->get();
        $nbrQuizzFini = count($nbrQuizzFini->unique('idQuizz'));

        $nbrTentative = scores::where('idUser', '=', $idUser)->get();
        $nbrTentative = count($nbrTentative);
        return view('UserInfo.show', compact('userInfo', 'lastScores', 'nbrCommentaire', 'nbrQuizzFini', 'nbrTentative'));
    }
}
