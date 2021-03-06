<?php

namespace App\Services;

use GuzzleHttp\Client;

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

    public function getCharacters(?int $page, array $characters = null):array
    {

        // no filter = fetch all
        $filter = '';

        // no characters subset is in parameters => returns empty array
        if (is_array($characters) && 0 === count($characters)) {
            return [];
        } elseif (is_array($characters)) {
            $filter =  '['.implode(',', $characters) . ']';
        }

        $query = $page ? ['query' => ['page' => $page]] : [] ;

        $res = $this->client->request('GET', self::API_URI.'character/'.$filter, $query);

        $arr = json_decode($res->getBody(), true);

        if (!isset($arr['results'])) {
            $tmpArr['info']['count'] = count($arr);
            $tmpArr["results"] = $arr;
            $arr = $tmpArr;
        }

        return $arr;
    }

    public function __call($name, $arguments)
    {

        $allowed = ['getCharactersByLocation','getCharactersByEpisode','getCharactersByDimension'];

        if (in_array($name, $allowed)) {
            $targetResource = mb_strtolower(explode('By', $name)[1]);
            $filterValue =  '['.$arguments[0].']';

            if ('dimension' === $targetResource) {
                $targetResource = 'location';
            }

            $uri  = self::API_URI. $targetResource . '/'.$filterValue;

            $res = $this->client->request('GET', $uri, []);
            $arr =  json_decode($res->getBody(), true);

            $key = 'location' === $targetResource ? 'residents' : 'characters';
            $characters = [];
         
            foreach ($arr as $item) {
                foreach ($item[$key] as $resident) {
                        $characters[] = intval(basename($resident));
                }
            }

            return array_unique($characters);
        }
    }

    public function getFilters(array $list = ['location','episode'])
    {
        $arr = [];

        foreach ($list as $item) {
            $res = $this->client->request('GET', self::API_URI."$item/", []);
            $data = json_decode($res->getBody(), true);
            $arr[$item] = $data['results'];
        }

        return $arr;
    }
}
