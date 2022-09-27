<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TwitterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $conn = new TwitterOAuth(
            config('services.twitter.api_key'),
            config('services.twitter.api_key_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret')
        );

        $tweets = $conn->get('statuses/home_timeline', [
            'count' => 5
        ]);

        return view('twitter.tweets', compact('tweets'));
    }
}
