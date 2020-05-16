<?php


namespace App\Controller;


use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    private $em;
    private $repository;
    public function __construct(DepartementRepository $repository, EntityManagerInterface $em)
    {
        //communik avk bd pour initialiser entitymana
        $this->em=$em;
        $this->repository=$repository;
    }

    /**
     * @Route("/departement/dep", name="departement_dep")
     *
     * @return Response
     */
    public function index():Response{

        return $this->render("page/departement.html.twig",
            [
                'departements'=> $this->repository->findAll()
            ]);
    }

    /**
     * @Route("/departement/edit/{id}", name="departement_edit", methods="GET|POST|PUT", requirements={"id":"[0-9]*"})
     * @param Departement $departement
     * @return Response
     */
    public function edit(Departement $departement, Response $request) : Response
    {
        //pour cree des form
        $form =  $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);
        //pour fair les update des client
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'departement a été bien edité!');
            return $this->redirectToRoute('departement_dep');
        }
        return $this->render('/page/editDepartement.html.twig',[
                'form' => $form->createView()
            ]

        );
    }

    /**
     * @Route("/departement/new", name="departement_create", requirements={"id":"[0-9]*"})
     *
     */
    public function add(Request $request) : Response
    {
        $departement =  new Departement();
        $form =  $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($departement);
            $this->em->flush();
            $this->addFlash('success', 'Le departement a été bien ajouté!');
            return $this->redirectToRoute('dep');
        }
        return $this->render('/page/addDepartement.html.twig',[
                'form' => $form->createView()
            ]

        );
    }

    /**
    @Route("/departement/delete/{id}", name="departement_delete", methods="DELETE", requirements={"id":"[0-9]"})
     * @return Response
     */
    public function delete(Departement $departement, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $departement->getId(), $request->get('_token'))){
            $this->em->remove($departement);
            $this->em->flush();
            $this->addFlash('success', 'departement a été bien supprimé!');
            return $this->redirectToRoute('departement_dep');
        }

        return $this->redirectToRoute('departement_dep');
    }

}