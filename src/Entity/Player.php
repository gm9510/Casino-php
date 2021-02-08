<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $Name;

    /**
     * @ORM\Column(type="float")
     */
    private $Money;

    public $bet = 0;
    public $color = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getMoney(): ?float
    {
        return $this->Money;
    }

    public function setMoney(float $Money): self
    {
        $this->Money = $Money;

        return $this;
    }

    public function pickBet(){
        $total = $this->Money;

        if( $total > 1000 ){
            $percent = random_int(8,15);
            $this->bet = round( ( $total * $percent ) / 100, 2 );
        } 
        else $this->bet = $total;
    }

    public function pickColor(){
        $num = random_int(1,100);

        if($num < 50) $this->color = 'r';
        else if($num <= 98) $this->color = 'b';
        else $this->color = 'g';
    }

    public function win( string $color ){
        if( $this->bet > 0){
            $this->Money=round( $this->Money + ( $color === 'g' ? 14 : 1 )*$this->bet, 2 );
        }
    }

    public function lose( ){
        if( $this->bet > 0 ) $this->Money = round( $this->Money - $this->bet, 2);
    }
}
