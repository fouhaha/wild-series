<?php

// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Category;
use App\Entity\ProgramRemarque;
// ATTENTION : La ligne ci-dessus est demandée dans la quête, mais ça doit être une erreur.
//             En effet, l'Entity ProgramRemarque n'éxistant pas, ce doit être l'entity Program, simplement.
//             A ce compte-là, la bonne commande "use" est déjà présente ci-dessus !
use App\Entity\Season;
use App\Form\ProgramSearchType;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
//  use Symfony\Component\BrowserKit\Request;
//  Ligne commentée car Request ne peut être utilisé qu'1 fois seulement.
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wild", name="wild_")
 */
class WildController extends AbstractController
{
//  La methode index() suivante est remplacée par la nouvelle méthode index(), ci-dessous.
//  ATTENTION : seuls les sommentaires relatifs à la mise en commentaire sont à supprimer si besoin !
/*
    /**
     * @Route("/wild", name="wild_index")
     */
/*
    public function index(): Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }
*/
//  ATTENTION : fin des commentaires relatifs à la mise en commentaire de l'ancienne methode index()

    /**
     * Show all rows from Program's entity
     *
     * @Route("/", name="index")
     * @param Request $request
     * @return Response A response instance
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(ProgramSearchType::class);
        $form->handleRequest($request);
            /*null,
            ['method' => Request::METHOD_GET]
        );*/

        if ($form->isSubmitted()) {
            $data = $form->getData();
        }

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                "No program found in program's table."
            );
        }

        return $this->render('wild/index.html.twig', [
            'programs' => $programs,
            'form' => $form->createView()
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

//  La methode show() suivante est remplacée par la nouvelle méthode show(), ci-dessous.
//  ATTENTION : seuls les sommentaires relatifs à la mise en commentaire sont à supprimer si besoin !
    /*
        /**
         * @Route("/wild/show/{slug}",
         *     requirements={"slug"="[a-z0-9-]+"},
         *     defaults={"slug"="aucune sélection"},
         *     name="wild_show"
         *  )
         * @param string $slug
         * @return Response
         */
/*
    public function show(string $slug): Response
    {
        return $this->render('wild/show.html.twig', ['slug' => ucwords(str_replace("-" , " ", $slug))]);
    }
*/
//  ATTENTION : fin des commentaires relatifs à la mise en commentaire de l'ancienne methode show()

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
     * @return Response
     */
    public function show(?string $slug):Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with '.$slug.' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig', [
            'program' => $program,
            'slug'  => $slug,
        ]);
    }

    /**
     * Getting the programs with a formatted categoryName for category
     *
     * @param string $categoryName
     * @Route("/category/{categoryName<^[a-z0-9-]+$>}", defaults={"categoryName" = null}, name="show_category")
     * @return Response
     */
    public function showByCategory(?string $categoryName): Response
    {

        if (!$categoryName) {
            throw $this->createNotFoundException(
                'No program with '.$categoryName.' category, found in program\'s table.'
            );
        }

        $categoryName = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($categoryName)), "-")
        );

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $category->getId('id')], ['id' => 'desc'], 3, 0);

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program with '.$categoryName.' category, found in program\'s table.'
            );
        }

        return $this->render('wild/category.html.twig', [
            'programs' => $programs,
            'categoryName'  => $categoryName,
        ]);
    }

    /**
     * @param string $slug
     * @Route("/program/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="showProgram")
     * @return Response
     */
    public function showByProgram(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with '.$slug.' title, found in program\'s table.'
            );
        }

        $seasons = $program->getSeasons();
        if (!$seasons) {
            throw $this->createNotFoundException(
                'No seasons with '.$slug.' program title, found in season\'s table.'
            );
        }

        return $this->render('wild/showProgram.html.twig', [
            'seasons' => $seasons,
            'slug'  => $slug,
            'program' => $program
        ]);
    }

    /**
     * @param int $id
     * @Route("/season/{id<^[0-9-]+$>}", defaults={"id" = null}, name="showSeason")
     * @return Response
     */
    public function showBySeason(int $id): Response
    {
        if (!$id) {
            throw $this
                ->createNotFoundException('No id has been sent to find a season in season\'s table.');
        }

        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id' => $id]);
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with '.$id.' id, found in season\'s table.'
            );
        }

        $program = $season->getProgram();
        $episodes = $season->getEpisodes();

        return $this->render('wild/showSeason.html.twig', [
            'season' => $season,
            'program'  => $program,
            'episodes' => $episodes
        ]);
    }
}
