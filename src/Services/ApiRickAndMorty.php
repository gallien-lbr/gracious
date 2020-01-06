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

        // no characters subset is in parameters => returns empty array
        if(is_array($characters) && 0 ===  count($characters)){
            return [];
        }elseif(is_array($characters)){
            $filter =  '['.implode(',',$characters) . ']';
        }

        $res = $this->client->request('GET', self::API_URI.'character/'.$filter, []);
        return json_decode($res->getBody(),true);
    }

    public function __call($name, $arguments){

        $allowed = ['getCharactersByLocation','getCharactersByEpisode','getCharactersByDimension'];

        if(in_array($name,$allowed)){

            $targetResource = mb_strtolower(explode('By',$name)[1]);
            $filterValue =  '['.$arguments[0].']';

            if('dimension' === $targetResource) {
                $targetResource = 'location';
            }

            $uri  = self::API_URI. $targetResource . '/'.$filterValue;

            $res = $this->client->request('GET', $uri  , []);
            $arr =  json_decode($res->getBody(),true);

            $key = 'location' === $targetResource ? 'residents' : 'characters';
            $characters = [];
         
            foreach ($arr as $item) {
                foreach ($item[$key] as $resident) {
                        $characters[] = intval(basename($resident));
                }
            }
            $characters = array_unique ($characters );

            /*$characters = array_map(function($e){
                return  basename($e);
            },$arr[$key]);*/

            return $characters;
        }
    }

    public function getFilters(array $list = ['location','episode']){
        $arr = [];

        foreach ($list as $item) {
            $res = $this->client->request('GET', self::API_URI."$item/",[]);
            $data = json_decode($res->getBody(),true);
            $arr[$item] = $data['results'];
        }

        return $arr;
    }

}