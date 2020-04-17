<?php


namespace App\Poker\Contracts;


interface CardRankInterface
{
    public function getRank(): int ;

    public function distance(CardRankInterface $other): int ;

    public function isSuccessive(CardRankInterface $other): int ;
}
