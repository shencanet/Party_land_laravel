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
            Log::info("Getting all parties");
            $parties = Canal::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all parties retrieved.",
                'data' => $parties
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting parties"
            ], 500);
        }
    }
    public function getCanalById($id)
    {
        try {
            Log::info("Getting party with id " . $id);
            $party = Canal::query()->find($id);
            if (!$party) {
                return response()->json([
                    'success' => true,
                    'message' => "Party not found",
                    'data' => $party
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Get party by id.",
                'data' => $party
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting party"
            ], 500);
        }
    }
    public function createCanal(Request $request)
    {
        try {
            Log::info("Creating party");

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'game_id' => 'required|integer'
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
            $newParty->game_id = $request->input("game_id");
            $newParty->save();

            return response()->json([
                'success' => true,
                'message' => "Party created succesfully",
                'data ' => $newParty
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error posting party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error posting party"
            ], 500);
        }
    }
    public function updateCanal($id, Request $request)
    {
        try {
            Log::info("Updating party with id " . $id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'game_id' => 'required|integer'
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
            $game_id = $request->input("game_id");

            $party = Canal::query()->find($id);
            if (!$party) {
                return response()->json([
                    'success' => true,
                    'message' => "Party not found",
                    'data' => $party
                ], 404);
            }
            
            if(isset($name)){
                $party->name = $request->input("name");
            }
            if(isset($game_id)){
                $party->game_id = $request->input("game_id");
            }
            $party->save();

            return response()->json([
                'success' => true,
                'message' => "Party updated succesfully",
                'data ' => $party
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error updating party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error updating party"
            ], 500);
        }
    }

    public function deleteCanal($id)
    {
        try{
            Log::info("Deleting party with id " . $id);

            $party = Canal::query()
                ->find($id)
                ->delete();
                
            return response()->json([
                'success' => true,
                'message' => "Party deleted succesfully",
                'data' => $party
            ], 200);

        }catch(\Exception $exception) {
            Log::error("Error deleting Exception party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting party"
            ], 500);
        }catch(\Throwable $exception){
            Log::error("Error deleting Throwable party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting party"
            ], 500);
        }
    }

    public function getCanalbyJuegoId($id)
    {
        try {
            Log::info("Getting party with game id " . $id);
            $party = Canal::query()
                ->where('game_id', $id)
                ->get()
                ->toArray();
                if (!$party) {
                    return response()->json([
                        'success' => true,
                        'message' => "Game not found",
                        'data' => $party
                    ], 404);
                }
            return response()->json([
                'success' => true,
                'message' => "Get party by game id.",
                'data' => $party
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting party"
            ], 500);
        }
    }
}