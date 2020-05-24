<?php

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index(): Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Bienvenue sur Wild Series',
        ]);
    }

    //@Route("/wild/show/{page}", requirements={"page"="\d+"}, name="wild_show")
    /**
     * @Route("/wild/show/{page}",
     *     requirements={"page"="\d+"},
     *     defaults={"page"=1},
     *     name="wild_show"
     * )
     */
    // Même route avec notation différente :
    // @Route("/wild/show/{page<\d+>?1}", name="wild_show")


    // Ici, on a 2 fois la même route avec une écriture différente. Mais le résultat est le même !
    // @Route("/wild/new", methods={"POST"}, name="wild_new")
    // Ci-dessus, exemple de redirection via la méthode POST uniquement !
    // @Route("/wild/{id}", methods={"GET"}, name="wild_show")
    // Ci-dessus, exemple de redirection via la méthode GET uniquement !
    // @Route("/wild/{id}", methods={"DELETE"}, name="wild_delete")
    // Ci-dessus, on limite la méthode à DELETE, pour la suppression d'une série, par ex.
    // Imposer les méthodes lors de la redirection permet d'éviter la confusion,
    // lors des redirections sur des mêmes pages !
    // NB : Il est possible de cumuler les méthodes (par ex : methods={"GET","POST"})
    public function show(int $page): Response
    {
        return $this->render('wild/show.html.twig', ['page' => $page]);
    }
}
