<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;

class YtbController extends Controller
{

   public function getAllVids() {
      // List videos in a given channel, return an array of PHP objects
      $videoList = Youtube::listChannelVideos('UC-MJeni5yPtQmTUKzvJW7-A', 40); //recupere tte les video d'une chaine
      $nbrVid = max(array_keys($videoList));

      for ($i = 0; $i <= $nbrVid; $i++) {
         $listId[$i] = $videoList[$i]->id->videoId;

      }
      return $listId;
   }
    public function displayYt() {
      $video = Youtube::getVideoInfo('7c-tZQqYP6A');
      // return $video->snippet->title;

      $listId = YtbController::getAllVids();


       $channel = Youtube::getChannelById('UC-MJeni5yPtQmTUKzvJW7-A');

     if (!empty($channel->id)) {
         //dd($channel->statistics->viewCount);
         $data = array('id' => $channel->id, 'title' => $channel->snippet->title, 'description' => $channel->snippet->description, 'viewcount' => $channel->statistics->viewCount, 'subscribers' => $channel->statistics->subscriberCount, 'comments' => $channel->statistics->commentCount, 'videos' => $channel->statistics->videoCount);

         return view('youtube.display', compact('listId', 'data'));
     }
     else {
         return 'sorry, connecting to youtube failed';
     }

    }
    public function carousel() {
      $listId = YtbController::getAllVids();
      return view('youtube.carousel', compact('listId'));
    }


}
