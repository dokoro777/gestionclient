<?php
namespace App\Controller;


use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends AbstractController {

    private $em;
    private $repository;
    public function __construct(ClientRepository $repository, EntityManagerInterface $em)
    {
        //communik avk bd pour initialiser entitymana
        $this->em=$em;
        $this->repository=$repository;
    }

    public function index():Response{
         $client= new Client();
         $client->setAdresse("derkle")
             ->setNom("Dokoro")
             ->setPrenom("francky")
             ->setCodeclient("1234");
        $this->em->persist($client);
        $this->em->flush();
        

        return $this->render("page/client.html.twig",
        [

        ]);
    }

}
?>