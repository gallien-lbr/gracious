<?php


namespace App\Controller;


use App\Entity\AContract;
use App\Form\AContractType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoController extends AbstractController
{

    public function index(Request $request):Response
    {
        $contract = new AContract;
        $frm = $this->createForm(AContractType::class,$contract);

        return new Response($this->render('newContract.html.twig',[
            'form' => $frm->createView(),

        ]));
    }
    
    
}