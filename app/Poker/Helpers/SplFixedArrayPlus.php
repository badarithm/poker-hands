<?php


namespace App\Poker\Helpers;

use \SplFixedArray;

/**
 * Adding some methods to ease tedium
 * Class SplFixedArrayPlus
 * @package App\Poker
 */
class SplFixedArrayPlus extends SplFixedArray
{
    /**
     * In many cases need to access previous element and then compare to it in some way.
     * Implementation violates scope rules and assumes that given array will not have
     * null values.
     * @param callable $handler
     * @return SplFixedArrayPlus
     */
    public function applyWithPrevious(callable $handler): SplFixedArrayPlus
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

    public function tail(): SplFixedArrayPlus
    {
        return $this->slice(1, $this->count() - 1);
    }

    /**
     * Returns a copy of itself except the last element
     * @return SplFixedArrayPlus
     */
    public function tailInverse(): SplFixedArrayPlus
    {
        return $this->slice(0, $this->count() - 1);
    }

    public function slice(int $startIndex, int $length)
    {
        $slice = new self(0);
        if (array_key_exists($startIndex, $this)) {
            $slice = new self($length);
            foreach ($this as $key => $value) {
                if ($startIndex <= $key && $key < $length) {
                    $slice[$key - $startIndex] = $value;
                }
            }
        }
        return $slice;
    }
}