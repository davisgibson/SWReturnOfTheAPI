<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class ListController extends Controller
{
    public function show()
    {
        return view('lists.show');
    }

    public function favorite(Request $request)
    {
        $request->validate([
            'url' => 'required',
        ]);
        //uses URL as an identifier because SWAPI doesn't return an ID. It is unique so it shouldn't cause problems.
        $url = $request->url;
        if($this->isFavorited($url))
            return $this->deleteFavorite($url);

        Favorite::create(['url' => $url]);

        return response(200);
    }

    private function isFavorited($url)
    {
        return Favorite::where('url', $url)->exists();
    }

    private function deleteFavorite($url)
    {
        return Favorite::where('url', $url)->delete();
    }
}
