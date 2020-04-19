<?php

namespace App\Http\Controllers;

use App\Models\Game\PokerMatch;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $pokerGames = PokerMatch::where('user_id', auth()->user()->id)->paginate(35);
        return view('theme.dashboard', compact('pokerGames'));
    }
}
