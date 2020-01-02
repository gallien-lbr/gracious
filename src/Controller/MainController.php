<?php

namespace App\Controller;

use App\Form\CharacterFilterType;
use App\Form\Model\CharacterFilterModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\ApiRickAndMorty;

class MainController extends AbstractController
{
    protected  $api;

    public function __construct()
    {
        $this->api = new ApiRickAndMorty();
    }

    public function index(int $page=2)
    {
        $filters = $this->api->getFilters();
        $characterFilter = new CharacterFilterModel();
        $characterFilter->locations = $filters['locations'];

        $form = $this->createForm(CharacterFilterType::class,$characterFilter);
        $data = json_decode($this->api->getCharacters("earth",$page)->__toString());

        return $this->render('./characters.html.twig',["data" => $data->results,"form" => $form->createView()] );
    }
}