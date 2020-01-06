<?php

namespace App\Controller;

use App\Form\CharacterFilterType;
use App\Form\Model\CharacterFilterModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\ApiRickAndMorty;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    protected  $api;

    public function __construct()
    {
        $this->api = new ApiRickAndMorty();
    }

    public function index(Request $request, int $page=null)
    {
        $filters = $this->api->getFilters();
        $characterFilter = new CharacterFilterModel();
        $characterFilter->locations = $filters['locations'];

        $form = $this->createForm(CharacterFilterType::class, $characterFilter);
        $form->handleRequest($request);
        $locId = null;

        if ($form->isSubmitted() && $form->isValid()){
           $data = $form->getData();
           $locId = $data->locations;

           if($locId){
               $characters = $this->api->getCharactersByLocationId($locId);
               $results = $this->api->getCharacters($characters,null);

                   if(!isset($results['results'])){
                       $res['info']['count'] = count($results);
                       $res["results"] = $results;
                   }else{
                       $res = $results;
                   }

               return $this->render('./characters.html.twig',["data" => $res,"form" => $form->createView()] );
           }
        }

        $data = $this->api->getCharacters(null,null);
        //dd($data);
        return $this->render('./characters.html.twig',["data" => $data,"form" => $form->createView()] );
    }
}