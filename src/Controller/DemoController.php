<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoController extends AbstractController
{

    public function index(Request $request):Response
    {
        //dd('test');
        return new Response('<body>test</body>');
    }
    
    
}