<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\PollVotes;
use Symfony\Component\HttpFoundation\Response;

class AnimalVoteController extends AbstractController
{
    /**
     * @Route("/", name="animal_index")
     */
    public function index()
    {

        $votes = $this->getDoctrine()->getRepository(PollVotes::class)->findAll();

        return $this->render('animal_vote/index.html.twig', [
            'hostname' => gethostname(),
        ]);
    }

    /**
     * @Route("/votes", name="animal_get_votes")
     * @Method({"GET"})
     */
    public function getVotes() {
        $votes = $this->getDoctrine()->getRepository(PollVotes::class)->findAll();
        return $this->render('animal_vote/votes.html.twig', [
            'votes' => $votes,
        ]);
    }

    /**
     * @Route("/votes/{animal}", name="animal_register_vote")
     * @Method({"POST"})
     */
    public function registerVote($animal)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $object = $entityManager->getRepository(PollVotes::class)->findOneByAnimal($animal);
        if (!$object) {
            throw $this->createNotFoundException(
                'No animal found for name '.$animal
            );
        }
        $object->setVotes($object->getVotes() +1);
        $entityManager->flush();
        return new Response();
    }
}