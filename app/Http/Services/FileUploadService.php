<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

ues \Exception;
/**
 * Service to handle uploaded file contents
 * Class FileUploadService
 * @package App\Http\Services
 */
class FileUploadService
{
    /**
     * Service has only one method anyway
     */
    public function __invoke(UploadedFile $file): bool
    {
        while(true) {
            $match = file_get_contents($file->getRealPath());

            // would have to compare strings + bools
            if ($match) {
                // $match string contains 10 cards
                $cards = explode(' ', $match);
                if (10 !== count($cards)) {
                    throw new Exception('Incorrect number of cards found while uploading matches.');
                }

                $first = array_slice($cards, 0, 5);
                $second = array_slice($cards, 5, 5);

                Log::debug(implode(' ', $first));
                Log::debug(implode(' ', $second));

                // Saves in db at this point
            } else {
                break;
            }
        }

        return true;
    }

}