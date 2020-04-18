<?php


namespace App\Poker\Helpers;

use \SplFixedArray;
use function foo\func;

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
     * null values. Initially it seemed to be very handy to check distances between
     * given card ranks.
     * @param callable $handler
     * @return SplFixedArrayPlus
     */
    public function applyWithPrevious(callable $handler): SplFixedArrayPlus
    {
        if (1 < $this->count()) {
            // Copy will always be of length original - 1, because the first element is used
            // for previous value initially. Thus have to check if it even makes sense to
            // calculate
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

    /**
     * Copy of itself except the first element
     * @return SplFixedArrayPlus
     */
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

    /**
     * To reduce iteration process in selection, etc..
     * @param callable $handler
     * @return SplFixedArray
     */
    public function filter(callable $handler)
    {
        $tempValues = array();
        foreach ($this as $key => $value) {
            if ($handler($value)) {
                array_push($tempValues, $value);
            }
        }
        return self::fromArray($tempValues);
    }

    public function map(callable $handler)
    {
        $duplicate = new self($this->count());
        foreach ($this as $key => $item) {
            $duplicate[$key] = $handler($item);
        }
        return $duplicate;
    }

    /**
     * Works pretty much the same way as array_slice(start, length)
     * Length is not optional, because in most cases required length is known or
     * can be calculated.
     * @param int $startIndex
     * @param int $length
     * @return SplFixedArrayPlus
     */
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

    /**
     * There is no real use case for this method. Just to generate
     * @param int $len
     * @param $min
     * @param $max
     * @return SplFixedArrayPlus
     */
    public static function randomFill(int $len, $min, $max) : SplFixedArrayPlus
    {
        $duplicate = new self($len);
        foreach ($duplicate as $key => $value) {
            $duplicate[$key] = random_int($min, $max);
        }
        return $duplicate;
    }

    /**
     * Cluster elements into groups using given function
     * @param callable $handler
     * @return SplFixedArrayPlus
     */
    public function cluster(callable $handler) : SplFixedArrayPlus
    {
        // TODO: still need to add this
        return $this;
    }
}