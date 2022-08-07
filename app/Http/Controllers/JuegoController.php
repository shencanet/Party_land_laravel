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
            Log::info("Getting all Juego");
            $Juego = Juego::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all Juegos retrieved.",
                'data' => $Juego
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting Juego: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting Juego"
            ], 500);
        }
    }
    public function getJuegosbyId($id)
    {
        try {
            Log::info("Getting Juego with id " . $id);
            $Juego = Juego::query()->find($id);
            if (!$Juego) {
                return response()->json([
                    'success' => true,
                    'message' => "Juego not found",
                    'data' => $Juego
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Get Juego by id.",
                'data' => $Juego
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting Juego: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting Juego"
            ], 500);
        }
    }
    public function createJuegos(Request $request)
    {
        try {
            Log::info("Creating Juego");
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'thumbnail_url' => 'required|string|max:255',
                'url' => 'required|string|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Error validating Juego",
                    'data' => $validator->errors()
                ], 400);
            }
            $newJuego = new Juego();

            $newJuego->title = $request->input("title");
            $newJuego->thumbnail_url = $request->input("thumbnail_url");
            $newJuego->url = $request->input("url");
            $newJuego->save();
            return response()->json([
                'success' => true,
                'message' => "Juego created.",
                'data' => $newJuego
            ]);
        } catch (\Exception $exception) {
            Log::error("Error creating Juego: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error creating Juego"
            ], 500);
        }
    }
    public function updateJuegos(Request $request, $id)
    {
        try {
            Log::info("Updating Juego with id " . $id);
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'thumbnail_url' => 'required|string|max:255',
                'url' => 'required|string|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Error validating Juego",
                    'data' => $validator->errors()
                ], 400);
            }
            $Juego = Juego::query()->find($id);
            if (!$Juego) {
                return response()->json([
                    'success' => true,
                    'message' => "Juego not found",
                    'data' => $Juego
                ], 404);
            }
            $title = $request->input("title");
            $thumbnail_url = $request->input("thumbnail_url");
            $url = $request->input("url");
            if(isset($title)){
                $Juego->title = $request->input("title");
            }
            if(isset($thumbnail_url)){
                $Juego->thumbnail_url = $request->input("thumbnail_url");
            }
            if(isset($url)){
                $Juego->url = $request->input("url");
            }
            
            $Juego->save();
            return response()->json([
                'success' => true,
                'message' => "Juego updated.",
                'data' => $Juego
            ]);
        } catch (\Exception $exception) {
            Log::error("Error updating Juego: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error updating Juego"
            ], 500);
        }
    }

    public function deleteJuegos($id)
    {
        try {
            Log::info("Deleting Juego with id " . $id);
            $Juego = Juego::query()->find($id);
            if (!$Juego) {
                return response()->json([
                    'success' => true,
                    'message' => "Juego not found",
                    'data' => $Juego
                ], 404);
            }
            $Juego->delete();
            return response()->json([
                'success' => true,
                'message' => "Juego deleted.",
                'data' => $Juego
            ]);
        } catch (\Exception $exception) {
            Log::error("Error deleting Juego: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error deleting Juego"
            ], 500);
        }
    }
}
