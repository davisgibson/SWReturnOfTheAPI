<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class StarWarsController extends Controller
{
    public function search(Request $request)
    {
        if($request->onlyShowFavorites !== "false")
        {
            return $this->getFavorites();
        }

        return $this->fetchResults($request->q);
    }

    private function fetchResults($q)
    {
        $response = Http::get("http://swapi.dev/api/people/", ['search' => $q]);

        return $this->parseFavorites(collect($response->json()['results']));
    }

    private function parseFavorites($results)
    {
        $favorites = Favorite::pluck('url');
        $results = $results->map(function($result) use ($favorites) {
            if($favorites->contains($result['url']))
                $result['isFavorite'] = true;
            return $result;
        });

        return $results;
    }

    private function getFavorites()
    {
        $favorites = Favorite::orderBy('updated_at', 'desc')->pluck('url');

        if(!$favorites->count())
            return collect([]);

        $responses = Http::pool(function (Pool $pool) use ($favorites) {
            foreach($favorites as $url)
            {
                $pool->get($url);
            }
        });

        $favorites = collect([]);

        foreach($responses as $response)
        {
            $item = json_decode($response->body());
            $item->isFavorite = true;
            $favorites->push($item);
        }

        return response()->json($favorites);
    }
}
