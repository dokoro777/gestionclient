<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends AbstractController {

     public function index():Response{

        return $this->render("page/client.html.twig");
    }

}
?>