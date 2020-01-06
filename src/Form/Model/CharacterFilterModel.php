<?php


namespace App\Form\Model;


class CharacterFilterModel
{
    public $location;
    public $episode;
    public $dimension = [];

    public function __construct(array $filters)
    {
        $this->location  = $filters['location'];
        $this->episode = $filters['episode'];

        foreach ($this->location as  $v){
             $this->dimension[$v['dimension']][] = $v['id'];
        }
        ksort($this->dimension);
    }


}