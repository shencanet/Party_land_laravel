<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JuegoController extends Controller
{
    public function getAllJuegos()
    {
        try {
            Log::info("Getting all games");
            $games = Juego::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all games retrieved.",
                'data' => $games
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting games: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting games"
            ], 500);
        }
    }
    public function getJuegosbyId($id)
    {
        try {
            Log::info("Getting game with id " . $id);
            $game = Juego::query()->find($id);
            if (!$game) {
                return response()->json([
                    'success' => true,
                    'message' => "Game not found",
                    'data' => $game
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Get game by id.",
                'data' => $game
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting games: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting game"
            ], 500);
        }
    }
    public function createJuegos(Request $request)
    {
        try {
            Log::info("Creating game");
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'thumbnail_url' => 'required|string|max:255',
                'url' => 'required|string|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Error validating game",
                    'data' => $validator->errors()
                ], 400);
            }
            $newGame = new Juego();

            $newGame->title = $request->input("title");
            $newGame->thumbnail_url = $request->input("thumbnail_url");
            $newGame->url = $request->input("url");
            $newGame->save();
            return response()->json([
                'success' => true,
                'message' => "Game created.",
                'data' => $newGame
            ]);
        } catch (\Exception $exception) {
            Log::error("Error creating game: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error creating game"
            ], 500);
        }
    }
    public function updateJuegos(Request $request, $id)
    {
        try {
            Log::info("Updating game with id " . $id);
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'thumbnail_url' => 'required|string|max:255',
                'url' => 'required|string|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Error validating game",
                    'data' => $validator->errors()
                ], 400);
            }
            $game = Juego::query()->find($id);
            if (!$game) {
                return response()->json([
                    'success' => true,
                    'message' => "Game not found",
                    'data' => $game
                ], 404);
            }
            $title = $request->input("title");
            $thumbnail_url = $request->input("thumbnail_url");
            $url = $request->input("url");
            if(isset($title)){
                $game->title = $request->input("title");
            }
            if(isset($thumbnail_url)){
                $game->thumbnail_url = $request->input("thumbnail_url");
            }
            if(isset($url)){
                $game->url = $request->input("url");
            }
            
            $game->save();
            return response()->json([
                'success' => true,
                'message' => "Game updated.",
                'data' => $game
            ]);
        } catch (\Exception $exception) {
            Log::error("Error updating game: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error updating game"
            ], 500);
        }
    }

    public function deleteJuegos($id)
    {
        try {
            Log::info("Deleting game with id " . $id);
            $game = Juego::query()->find($id);
            if (!$game) {
                return response()->json([
                    'success' => true,
                    'message' => "Game not found",
                    'data' => $game
                ], 404);
            }
            $game->delete();
            return response()->json([
                'success' => true,
                'message' => "Game deleted.",
                'data' => $game
            ]);
        } catch (\Exception $exception) {
            Log::error("Error deleting game: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error deleting game"
            ], 500);
        }
    }
}
