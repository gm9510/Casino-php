<?php

namespace App\Controller;

use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( EntityManagerInterface $entityManager ): Response
    {
        $players = $entityManager->getRepository( Player::class )->findAll();
        foreach( $players as $player ){
            $player->pickBet();
            $player->pickColor();
        }

        // Assuming that random_init() provides a uniform distribution
        $casinoColor = '';
        $num = random_int(1,100);
        if($num < 50){
            $casinoColor = 'r';
        }
        else if($num <= 98){
            $casinoColor = 'b';
        }
        else{
            $casinoColor = 'g';
        }

        foreach( $players as $player ){
            if ( $casinoColor === $player->color ) $player->win( $casinoColor );
            else $player->lose();
        }

        $entityManager->flush();

        return $this->render('home/index.html.twig', [
            'players'=> $players,
            'color' => $casinoColor
        ]);
    }

}
