<?php

namespace App\Controller;

use App\Entity\Player;
use App\Util\Roulette; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function index( EntityManagerInterface $entityManager, Roulette $roulette ): Response
    {
        $players = $entityManager->getRepository( Player::class )->findAll();

        $baseMoney = [];// Money per player before the game starts
        foreach( $players as $player ){
            $baseMoney[$player->getId()] = "{$player->getMoney()}";
            $player->pickBet();
            $player->pickColor();
        }

        $casinoColor = $roulette->random_color();

        foreach( $players as $player ){
            if ( $casinoColor === $player->color ) $player->win( $casinoColor );
            else $player->lose();
        }

        $entityManager->flush();

        return $this->render('home/index.html.twig', [
            'players' => $players,
            'basemoney' => $baseMoney,
            'color' => $casinoColor
        ]);
    }

}
