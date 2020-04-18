<?php


namespace App\Poker\Helpers;

use \SplFixedArray;

/**
 * Adding some methods to ease tedium
 * With small number of items there will be no speed gain.
 * But the nice thing is that lots of looping and transforming can be done in more fluent fashion
 * Class ExtendedSplFixedArray
 * @package App\Poker
 */
class ExtendedSplFixedArray extends SplFixedArray implements SplFixedArrayExtensionInterface
{
    /**
     * In many cases need to access previous element and then compare to it in some way.
     * Implementation violates scope rules and assumes that given array will not have
     * null values. Initially it seemed to be very handy to check distances between
     * given card ranks.
     * @param callable $handler
     * @return SplFixedArrayExtensionInterface
     */
    public function applyWithPrevious(callable $handler): SplFixedArrayExtensionInterface
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
     * @return SplFixedArrayExtensionInterface
     */
    public function tail(): SplFixedArrayExtensionInterface
    {
        return $this->slice(1, $this->count() - 1);
    }

    /**
     * Returns a copy of itself except the last element
     * @return SplFixedArrayExtensionInterface
     */
    public function tailInverse(): SplFixedArrayExtensionInterface
    {
        return $this->slice(0, $this->count() - 1);
    }

    /**
     * To reduce iteration process in selection, etc..
     * @param callable $handler
     * @return SplFixedArray
     */
    public function filter(callable $handler): SplFixedArrayExtensionInterface
    {
        $tempValues = array();
        foreach ($this as $key => $value) {
            if ($handler($value)) {
                array_push($tempValues, $value);
            }
        }

        $duplicate = new self(count($tempValues));
        foreach ($tempValues as $key => $value) {
            $duplicate[$key] = $value;
        }
        return $duplicate;
    }

    public function map(callable $handler): SplFixedArrayExtensionInterface
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
     * @return ExtendedSplFixedArray
     */
    public function slice(int $startIndex, int $length): SplFixedArrayExtensionInterface
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
     * There is no real use case for this method. Just to generate random arrays.
     * @param int $len
     * @param $min
     * @param $max
     * @return ExtendedSplFixedArray
     */
    public static function randomFill(int $len, $min, $max) : SplFixedArrayExtensionInterface
    {
        $duplicate = new self($len);
        foreach ($duplicate as $key => $value) {
            $duplicate[$key] = random_int($min, $max);
        }
        return $duplicate;
    }

    /**
     * Cluster elements into groups using given function
     * Likely use case is to group cards based on their suit.
     * This works well for small number of
     * @param callable $handler
     * @return ExtendedSplFixedArray
     */
    public function cluster(callable $handler): SplFixedArrayExtensionInterface
    {
        $cluster = array();
        $duplicate = clone $this;
        foreach ($duplicate as $firstKey => $firstValue) {
            foreach ($duplicate as $secondKey => $secondValue) {
                [$key, $status] = $handler($firstValue, $secondValue);
                if ($status) {
                   if (!array_key_exists($key, $cluster)) {
                       $cluster[$key] = array();
                   }
                   array_push($cluster[$key], $secondValue);
                   array_splice($duplicate, $secondKey, 1);
                    // This will prevent conditions where values are skipped
                    // because entries were removed.
                   reset($duplicate);
                }
            }
        }
        return $this;
    }

//    protected function sum(callable $handler): int
//    {
//        return $this->applyWithPrevious($handler)->reduce(function($carry, $value) {
//            return $carry + $value;
//        });
//    }
}