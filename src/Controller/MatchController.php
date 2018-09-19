<?php

namespace App\Controller;

use App\Entity\Match;
use App\Repository\MatchRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
