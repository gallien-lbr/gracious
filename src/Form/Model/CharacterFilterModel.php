<?php


namespace App\Form\Model;


class CharacterFilterModel
{
    //public $dimension;
    public $location;
    public $episode;

    public function __construct(array $location, array $episode)
    {
        $this->location  = $location;
        $this->episode = $episode;
    }

}