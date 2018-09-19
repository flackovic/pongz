<?php

namespace App\Controller;

use App\Entity\Match;
use App\Repository\MatchRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{
    /**
     * @Route("/matches", name="match_index")
     */
    public function index(EntityManagerInterface $em)
    {
        /** @var MatchRepository $matchRepository */
        $matchRepository = $em->getRepository(Match::class);
        $matches = $matchRepository->findLatest();

        return $this->render('match/index.html.twig', [
            'matches' => $matches,
        ]);
    }

    /**
     * @Route("/match/{matchId}", name="match_view")
     */
    public function view(EntityManagerInterface $em, $matchId)
    {
        /** @var MatchRepository $matchRepository */
        $matchRepository = $em->getRepository(Match::class);
        $match = $matchRepository->findOneBy(['id' => $matchId]);

        if(!$match) {
            throw new NotFoundHttpException();
        }

        return $this->render('match/view.html.twig', [
            'match' => $match,
        ]);
    }
}
