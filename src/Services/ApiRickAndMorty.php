<?php

namespace App\Services;
use GuzzleHttp\Client;

//echo $res->getStatusCode();
////echo $res->getHeader('content-type')[0];

/**
 * Utility class to call API
 * Class ApiRickAndMorty
 * @package App\Services
 */
class ApiRickAndMorty
{
    const API_URI = 'https://rickandmortyapi.com/api/';
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getCharacters(array $characters = null,int $page=null){

        // no filter = fetch all
        $filter = '';

        // no characters subset sent in parameters, returns none
        if(is_array($characters) && 0 ===  count($characters)){
            return [];
        }elseif(is_array($characters)){
            $filter =  '['.implode(',',$characters) . ']';
        }

        $res = $this->client->request('GET', self::API_URI.'character/'.$filter, []);
        return json_decode($res->getBody(),true);
    }

    public function __call($name, $arguments){

        $allowed = ['getCharactersByLocation','getCharactersByEpisode'];

        if(in_array($name,$allowed)){
            $id = $arguments[0];
            $targetResource = mb_strtolower(explode('By',$name)[1]);
            $uri  = self::API_URI. $targetResource . '/'.$id;
            //dd($uri);
            $res = $this->client->request('GET', $uri  , []);
            $arr =  json_decode($res->getBody(),true);

            $key = 'location'=== $targetResource ? 'residents' : 'characters';

            $characters = array_map(function($e){
                return  basename($e);
            },$arr[$key]);

            return $characters;
        }
    }

    public function getFilters(array $list){
        $arr = [];

        foreach ($list as $item) {
            $res = $this->client->request('GET', self::API_URI."$item/",[]);
            $data = json_decode($res->getBody(),true);
            $arr[$item] = $data['results'];
        }

        return $arr;
    }

}