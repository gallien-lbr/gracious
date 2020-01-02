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

    public function getCharacters(string $dimension,int $page){

        $res = $this->client->request('GET', self::API_URI.'character/',
                                              [
                                               'dimension' => $dimension,
                                               'page' => $page
                                              ]);


        return $res->getBody();
    }

    public function getFilters(){

        $res = $this->client->request('GET', self::API_URI.'location/',[]);
        $locations = json_decode($res->getBody(),true);

        return ['locations' => $locations['results']];
    }

}