<?php


namespace App\Poker\Helpers;

use \SplFixedArray;

/**
 * Adding some methods to ease tedium
 * Class SplFixedArrayExtended
 * @package App\Poker
 */
class SplFixedArrayExtended extends SplFixedArray
{
    /**
     * In many cases need to access previous element and then compare to it in some way.
     * Implementation violates scope rules and assumes that given array will not have
     * null values.
     * @param callable $handler
     * @return SplFixedArrayExtended
     */
    public function applyWithPrevious(callable $handler): SplFixedArrayExtended
    {
        if (1 < $this->count()) {
            $processedCollection = new self($this->count() - 1);
            $previous = null;
            foreach ($this as $key => $current) {
                if (null !== $previous) {
                    $processedCollection[$key - 1] = function($current) use ($previous, $handler) {
                        return $handler($previous, $current);
                    };
                }
                $previous = $current;
            }
        } else {
            $processedCollection = new self(0);
        }
        return $processedCollection;
    }
}