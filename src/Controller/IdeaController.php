<?php

namespace App\Controller;

use App\Entity\Idea;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IdeaController extends AbstractController
{

    #[Route("/ideas", name: "idea_list")]
    public function list(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Idea::class);
        $ideas = $repo->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);

        return $this->render("idea/list.html.twig", ["ideas" => $ideas]);
    }

    #[Route("/ideas/{id}", name: "idea_detail", requirements: ["id" => "\d+"])]
    public function detail(int $id, EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Idea::class);
        $idea = $repo->find($id);

        return $this->render("idea/detail.html.twig", ["idea" => $idea]);
    }
}
