@extends('theme.main')

@section('content')
    @include('theme.table', array(
            'collection' => $pokerGames,
            'titles' => array(
                'Match Id' => 'match_id',
                'Player Cards' => 'player_cards',
                'Opponent Cards' => 'opponent_cards',
                'Winner' => 'winner'
                ))
            )
@endsection