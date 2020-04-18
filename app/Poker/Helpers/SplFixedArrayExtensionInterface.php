<?php


namespace App\Poker\Helpers;

use \Iterator;
use \ArrayAccess;
use \Countable;
/**
 * Have to make it compatible with actual SplFixedArray class
 * Interface SplFixedArrayExtensionInterface
 * @package App\Poker\Helpers
 */
interface SplFixedArrayExtensionInterface extends Iterator, ArrayAccess, Countable
{

    public function applyWithPrevious(callable $handler): self ;

    public function tail(): self ;

    public function tailInverse(): self ;

    public function filter(callable $handler): self ;

    public function map(callable $handler): self ;

    public function slice(int $startIndex, int $length): self ;

    /**
     * To group items based on some given condition. Assumption here is taken that one item
     * from collection can match at most once (specific case is to match suit).
     * Once cards can be matched by suit, then distances can be calculated
     * between their weights in certain game rules.
     * @param callable $handler
     * @return $this
     */
    public function cluster(callable $handler): self ;

    public static function randomFill(int $length, int $min, int $max): self ;
}