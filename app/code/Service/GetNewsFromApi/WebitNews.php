<?php

namespace Service\GetNewsFromApi;

use Model\News;

class WebitNews
{

    public function exec()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://webit-news-search.p.rapidapi.com/trending?language=en",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: webit-news-search.p.rapidapi.com",
                "X-RapidAPI-Key: cb2a3b767emsh67d0db05f85772bp108d81jsn3c26ea4114ac"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
            echo '<pre>';
            print_r($response->data->results);
            $newsFromWebit = $response->data->results;
            foreach ($newsFromWebit as $newFromWebit){
                $new = new News();
                $new->setTitle($newFromWebit->title);
                $new->setSlug(str_replace(' ','-', $newFromWebit->title));
                if($newFromWebit->description){
                    $new->setContent($newFromWebit->description);
                }else{
                    $new->setContent('Cia buvo tik skambi antraste ;)');
                }
                $new->setCreatedAt($newFromWebit->date);
                $new->setImage($newFromWebit->image);
                $new->setViews(0);
                $new->setActive(1);
                $new->setAuthorId(1);
                $new->save();
            }
        }
    }
}