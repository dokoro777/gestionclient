<?php


namespace App\Controller;


use App\Entity\Employ;
use App\Form\EmployType;
use App\Repository\EmployRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController
{
    private $em;
    private $repository;
    public function __construct(EmployRepository $repository, EntityManagerInterface $em)
    {
        //communik avk bd pour initialiser entitymana
        $this->em=$em;
        $this->repository=$repository;
    }

    /**
     * @Route("/employe/show", name="employe_show")
     *
     * @return Response
     */
    public function show():Response{


    return $this->render("page/employer.html.twig",
        [
            'employs'=> $this->repository->findAll()
        ]);
    }

    /**
     * @Route("/employe/edit/{id}", name="employe_create", methods="GET|POST|PUT", requirements={"id":"[0-9]*"})
     * @param Employ $employer
     * @return Response
     */
    public function edit(Employ $employ, Response $request) : Response
    {
        //pour cree des form
        $form =  $this->createForm(EmployType::class, $employ);
        $form->handleRequest($request);
        //pour fair les update des client
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'employer a été bien edité!');
            return $this->redirectToRoute('show');
        }
        return $this->render('/page/editEmployer.html.twig',[
                'form' => $form->createView()
            ]

        );
    }


    /**
     * @Route("/employ/new", name="employe_create", requirements={"id":"[0-9]*"})
     *
     */
    public function add(Request $request) : Response
    {
        $employ =  new Employ();
        $form =  $this->createForm(EmployType::class, $employ);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($employ);
            $this->em->flush();
            $this->addFlash('success', 'Le employer a été bien ajouté!');
            return $this->redirectToRoute('show');
        }
        return $this->render('/page/addEmployer.html.twig',[
                'form' => $form->createView()
            ]

        );
    }
    /**
    @Route("/employe/delete/{id}", name="employer_delete", methods="DELETE", requirements={"id":"[0-9]"})
     * @return Response
     */
    public function delete(Employ $employ, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $employ->getId(), $request->get('_token'))){
            $this->em->remove($employ);
            $this->em->flush();
            $this->addFlash('success', 'employer a été bien supprimé!');
            return $this->redirectToRoute('show');
        }

        return $this->redirectToRoute('show');
    }

}