<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IdeaController extends AbstractController
{

    #[Route("/ideas", name: "idea_list")]
    public function list(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Idea::class);
        $ideas = $repo->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);

        return $this->render("idea/list.html.twig", ["ideas" => $ideas]);
    }

    #[Route('/ideas/new', name: 'idea_new')]
    public function new(Request $request, EntityManagerInterface $em)
    {
        $idea = new Idea();

        $form = $this->createForm(IdeaType::class, $idea);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idea->setDateCreated(new DateTime());
            $idea->setIsPublished(true);

            $em->persist($idea);
            $em->flush();

            $this->addFlash('success', 'Idea successfully added !');

            return $this->redirectToRoute('idea_detail', ['id' => $idea->getId()]);
        }

        return $this->render('idea/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/ideas/{id}", name: "idea_detail", requirements: ["id" => "\d+"])]
    public function detail(int $id, EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Idea::class);
        $idea = $repo->find($id);

        return $this->render("idea/detail.html.twig", ["idea" => $idea]);
    }
}
