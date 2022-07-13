<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\GameResource;

use App\Models\Game;

class GameApiController extends Controller
{

    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'genre_id' => 'array',
            'genre_id.*' => 'integer',
            'development_studio_id' => 'array',
            'development_studio_id.*' => 'integer'

        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $games = Game::with(['genres', 'developmentStudio']);
        if ($request->genre_id) {
            $games->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('genre_id', $request->genre_id);
            });
        }

        if ($request->development_studio_id) {
            $games->whereIn('development_studio_id', $request->development_studio_id);
        }

        return GameResource::collection($games->get());
    }

    public function find($id)
    {
        $game = Game::findOrFail($id);
        return GameResource::collection([$game]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:games,name',
            'development_studio_id' => 'required|integer|exists:development_studios,id',
            'genres' => 'required|array|exists:genres,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $game = Game::create($request->all());
        $game->genres()->sync($request->genres);

        return GameResource::collection([$game]);
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|unique:games,name,' . $game->id,
            'development_studio_id' => 'integer|exists:development_studios,id',
            'genres' => 'array|exists:genres,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $game->update($request->all());
        $game->genres()->sync($request->genres);

        return GameResource::collection([$game]);
    }

    public function delete($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();
        return ['message' => 'Game has been deleted successfully'];
    }
}
