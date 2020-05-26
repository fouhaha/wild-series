<?php

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
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
            'website' => 'Wild Séries',
        ]);
    }

    //@Route("/wild/show/{page}", requirements={"page"="\d+"}, name="wild_show")
    //
     // @Route("/wild/show/{page}",
     //     requirements={"page"="\d+"},
     //     defaults={"page"=1},
     //     name="wild_show"
     // )

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

    /**
     * @Route("/wild/show/{slug}",
     *     requirements={"slug"="[a-z0-9-]+"},
     *     defaults={"slug"="aucune sélection"},
     *     name="wild_show"
     *  )
     * @param string $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        return $this->render('wild/show.html.twig', ['slug' => ucwords(str_replace("-" , " ", $slug))]);
    }
}
