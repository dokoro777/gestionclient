<?php
namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        /* $client= new Client();
         $client->setAdresse("derkle")
             ->setNom("Dokoro")
             ->setPrenom("francky")
             ->setCodeclient("1234")
             ->setTel("78900");*/
        //$this->em->persist($client);
        //$this->em->flush();


        return $this->render("page/client.html.twig",
        [
            'clients'=> $this->repository->findAll()
        ]);
    }
//
    /**
     * @Route("/client/edit/{id}", name="client_edit", methods="GET|POST|PUT", requirements={"id":"[0-9]*"})
     * @param Client $client
     * @return Response
     */
    public function edit(Client $client, Response $request) : Response
    {
        //pour cree des form
        $form =  $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        //pour fair les update des client
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le client a été bien edité!');
            return $this->redirectToRoute('index');
        }
        return $this->render('/page/editClient.html.twig',[
                'form' => $form->createView()
            ]

        );
    }

    /**
     * @Route("/client/new", name="client_create", requirements={"id":"[0-9]*"})
     *
     */
    public function add(Request $request) : Response
    {
        $client =  new Client();
        $form =  $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $client->setCodeclient(uniqid());
            $this->em->persist($client);
            $this->em->flush();
            $this->addFlash('success', 'Le client a été bien ajouté!');
            return $this->redirectToRoute('index');
        }
        return $this->render('/page/addClient.html.twig',[
                'form' => $form->createView()
            ]

        );
    }
    /**
    @Route("/client/delete/{id}", name="client_delete", methods="DELETE", requirements={"id":"[0-9]"})
     * @return Response
     */
    public function delete(Client $client, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->get('_token'))){
            $this->em->remove($client);
            $this->em->flush();
            $this->addFlash('success', 'client a été bien supprimé!');
            return $this->redirectToRoute('index');
        }

        return $this->redirectToRoute('index');
    }

}
?>