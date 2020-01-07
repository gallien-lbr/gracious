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

    public function index(Request $request, int $page)
    {
        $view = './characters.html.twig';
        $viewData = [];

        $filters = $this->api->getFilters();

        $characterFilter = new CharacterFilterModel($filters);

        $form = $this->createForm(CharacterFilterType::class, $characterFilter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            if ($form->getClickedButton()) {
               $fieldName = explode('_',$form->getClickedButton()->getName())[1];
            }

            $id  = $data->$fieldName;

            if($id){
                   $getMethod = "getCharactersBy".ucwords($fieldName);
                   $characters = $this->api->$getMethod($id);
                   $results = $this->api->getCharacters(null,$characters);

                   if(!isset($results['results'])){
                       $viewData['info']['count'] = count($results);
                       $viewData["results"] = $results;
                   }else{
                       $viewData = $results;
                   }
                    return $this->render($view,["data" => $viewData,"form" => $form->createView()] );
             }

        }

        $viewData = $this->api->getCharacters($page);

        return $this->render($view,["data" => $viewData,"form" => $form->createView()] );
    }
}