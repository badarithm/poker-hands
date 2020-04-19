<?php

namespace App\Http\Services;

use App\Models\Game\PokerMatch;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use \Exception;
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
    public function uploadFile(UploadedFile $file): bool
    {
        if (file_exists($file->getRealPath())) {
            $fileHandle = fopen($file->getRealPath(), 'r');
            while(true) {
                $match = fgets($fileHandle);
                // have to compare strings + bools at this point
                if ($match) {
                    // $match string contains 10 cards
                    $cards = explode(' ', $match);
                    if (10 !== count($cards)) {
                        throw new Exception('Incorrect number of cards found.');
                    }

                    $hands = array_chunk($cards, 5);

                    $match = PokerMatch::create([
                        'user_id' => auth()->user()->id,
                    ]);

                    foreach ($hands as $key => $hand) {
                        $match->hands()->create([
                            'cards' => implode(' ', $hand),
                            'belongs_to_user' => 0 === $key ? 1 : 0,
                            'is_winner' => 0,
                        ]);
                    }
                } else {
                    break;
                }
            }
            return true;
        }
        throw new Exception('File does not exist.');
    }
}