<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Utility extends Controller
{
    //
    public function get() {
        $client = new \GuzzleHttp\Client();
        $send = $client->request(
            'GET',
            'https://kusonime.com'
        );
        $response_body = $send->getBody();

        preg_match_all('#<h2 class=\'episodeye\'><a href="(.*?)" title="(.*?)">(.*?)</a></h2>#', $response_body, $outs);
        $data = [
            'url' => $outs[1],
            'title' => $outs[2]
        ];
        return $data;
    }

    public function post(Request $request) {
        $url = $request->url;

        $client = new \GuzzleHttp\Client();
        $send = $client->request(
            'GET',
            $url
        );
        $response_body = $send->getBody();

        preg_match_all('#<div class="smokeurl">(.*?)</div>#', $response_body, $outs);
        $urls = ['360P' => [], '480P' => [], '720P' => [], '1080P' => []];

        foreach($outs[1] as $outis) {
            preg_match('#<strong>(.*?)</strong>#', $outis, $aits);
            preg_match_all('#href="(.*?)"#', $outis, $aitss);
            array_push($urls[$aits[1]], $aitss[1]);
        }

        return $urls;
    }
}
