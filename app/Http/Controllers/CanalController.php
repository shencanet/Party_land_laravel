<?php

namespace App\Http\Controllers;

use App\Models\Canal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    public function getAllCanal()
    {
        try {
            Log::info("Getting all Canal");
            $canal = Canal::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all canal retrieved.",
                'data' => $canal
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting canal: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting canal"
            ], 500);
        }
    }
    public function getCanalById($id)
    {
        try {
            Log::info("Getting canal with id " . $id);
            $canal = Canal::query()->find($id);
            if (!$canal) {
                return response()->json([
                    'success' => true,
                    'message' => "Party not found",
                    'data' => $canal
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Get party by id.",
                'data' => $canal
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting canal: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting party"
            ], 500);
        }
    }
    public function createCanal(Request $request)
    {
        try {
            Log::info("Creating canal");

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'canal_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        'message' => "Error creating party",
                        "message" => $validator->errors()
                    ],
                    400
                );
            };
            $newParty = new Canal();

            $newParty->name = $request->input("name");
            $newParty->canal_id = $request->input("canal_id");
            $newParty->save();

            return response()->json([
                'success' => true,
                'message' => "canal created succesfully",
                'data ' => $newcanal
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error posting canal: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error posting canal"
            ], 500);
        }
    }
    public function updateCanal($id, Request $request)
    {
        try {
            Log::info("Updating canal with id " . $id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'canal_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };
            $name = $request->input("name");
            $canal_id = $request->input("canal_id");

            $canal = Canal::query()->find($id);
            if (!$canal) {
                return response()->json([
                    'success' => true,
                    'message' => "Party not found",
                    'data' => $canal
                ], 404);
            }
            
            if(isset($name)){
                $canal->name = $request->input("name");
            }
            if(isset($game_id)){
                $canal->game_id = $request->input("canal_id");
            }
            $canal->save();

            return response()->json([
                'success' => true,
                'message' => "canal updated succesfully",
                'data ' => $canal
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error updating canal: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error updating canal"
            ], 500);
        }
    }

    public function deleteCanal($id)
    {
        try{
            Log::info("Deleting canal with id " . $id);

            $canal = Canal::query()
                ->find($id)
                ->delete();
                
            return response()->json([
                'success' => true,
                'message' => "Party deleted succesfully",
                'data' => $canal
            ], 200);

        }catch(\Exception $exception) {
            Log::error("Error deleting Exception canal: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting canal"
            ], 500);
        }catch(\Throwable $exception){
            Log::error("Error deleting Throwable canal: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting canal"
            ], 500);
        }
    }

    public function getCanalbyJuegoId($id)
    {
        try {
            Log::info("Getting canal with game id " . $id);
            $canal = Canal::query()
                ->where('juego_id', $id)
                ->get()
                ->toArray();
                if (!$canal) {
                    return response()->json([
                        'success' => true,
                        'message' => "canal not found",
                        'data' => $canal
                    ], 404);
                }
            return response()->json([
                'success' => true,
                'message' => "Get canal by canal id.",
                'data' => $canal
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting canal"
            ], 500);
        }
    }
}