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

    /**
     * For cases where some check needs to be done against the previous element.
     * Will return a copy of n - 1 elements. For 0, 1 length lists
     * will return 0 element list.
     * @param callable $handler
     * @return $this
     */
    public function applyWithPrevious(callable $handler): self ;

    /**
     * Special case of slice method. Returns a list without the first element
     * @return $this
     */
    public function tail(): self ;

    /**
     * Special case of slice, where the last element, should be ignored
     * @return $this
     */
    public function tailInverse(): self ;

    /**
     * Same as array_filter. Workaround, because that specific function
     * doesn't work nicely with traversable objects.
     * @param callable $handler
     * @return $this
     */
    public function filter(callable $handler): self ;

    /**
     * Same array_map(), but works with objects that array_map considers invalid.
     * @param callable $handler
     * @return $this
     */
    public function map(callable $handler): self ;

    /**
     * Get a list excerpt of the original, without modifying the original one.
     * @param int $startIndex
     * @param int $length
     * @return $this
     */
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

    /**
     * Doesnt have specific use case. Added to test clustering with odd / even numbers.
     * @param int $length
     * @param int $min
     * @param int $max
     * @return static
     */
    public static function randomFill(int $length, int $min, int $max): self ;

    public function sum(): int ;
}