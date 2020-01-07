<?php

namespace App\Controller;

use App\Form\CharacterFilterType;
use App\Form\Model\CharacterFilterModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\ApiRickAndMorty;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    public function index(Request $request, int $page)
    {
        $api =  new ApiRickAndMorty();
        $view = './characters.html.twig';

        $characterFilter = new CharacterFilterModel($api->getFilters());
        $form = $this->createForm(CharacterFilterType::class, $characterFilter);
        $viewParams = ["data" => null,"form" => $form->createView()];
        $form->handleRequest($request);

        // display a subset of characters using filter
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $fieldName = explode('_', $form->getClickedButton()->getName())[1];
            $postValues  = $data->$fieldName;

            if ($postValues) {
                   $getMethod = "getCharactersBy".ucwords($fieldName);
                   $characters = $api->$getMethod($postValues);
                   $viewParams['data'] = $api->getCharacters(null, $characters);

                   return $this->render($view, $viewParams);
            }
        }
        // display all characters per page
        $viewParams['data'] = $api->getCharacters($page);
        return $this->render($view, $viewParams);
    }
}
