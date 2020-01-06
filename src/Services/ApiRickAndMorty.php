<?php

namespace App\Services;
use GuzzleHttp\Client;

//echo $res->getStatusCode();//echo $res->getHeader('content-type')[0];
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


    public function getCharactersByLocationId($id=null):array{
        $res = $this->client->request('GET', self::API_URI.'location/'.$id , []);
        $arr =  json_decode($res->getBody(),true);

        $characters = array_map(function($e){
            return  basename($e);
         },$arr['residents']);

        return $characters;
    }

    public function getFilters(){

        $res = $this->client->request('GET', self::API_URI.'location/',[]);
        $locations = json_decode($res->getBody(),true);

        return ['locations' => $locations['results']];
    }

}