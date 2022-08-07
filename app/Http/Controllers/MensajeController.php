<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MensajeController extends Controller
{
    public function getAllMensaje()
    {
        try {
            Log::info("Getting all messages");
            $Mensajes = Mensaje::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all messages retrieved.",
                'data' => $Mensajes
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting messages: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting messages"
            ], 500);
        }
    }

    public function getMensajeById($id)
    {
        try {
            Log::info("Getting message with id " . $id);
            $Mensaje = Mensaje::query()->find($id);
            if (!$Mensaje) {
                return response()->json([
                    'success' => true,
                    'message' => "Message not found",
                    'data' => $Mensaje
            }
            return response()->json([
                'success' => true,
                'message' => "Get message by id.",
                'data' => $Mensaje
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting messages: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting message"
            ], 500);
        }
    }

    public function createMensaje(Request $request)
    {
        try {
            Log::info("Creating message");
            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'from' => 'required|integer',
                'party_id' => 'required|integer',
                'date' => 'required|date'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Error creating message",
                    'data' => $validator->errors()
                ], 400);
            }
            $newMensaje = new Mensaje();
            $newMensaje->message = $request->input("message");
            $newMensaje->from = $request->input("from");
            $newMensaje->party_id = $request->input("party_id");
            $newMensaje->date = $request->input("date");
            $newMMensaje->save();
            return response()->json([
                'success' => true,
                'message' => "Message created.",
                'data' => $newMensaje
            ]);
        } catch (\Exception $exception) {
            Log::error("Error creating message: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error creating message"
            ], 500);
        }
    }
    public function updateMensaje($id, Request $request)
    {
        try {
            Log::info("Updating message with id " . $id);

            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'from' => 'required|integer',
                'party_id' => 'required|integer',
                'date' => 'required|date'
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
            $Mensaje = $request->input("message");
            $from = $request->input("from");
            $party_id = $request->input("party_id");
            $date = $request->input("date");

            $MensajeUpdate = Mensaje::query()->find($id);
            if (!$MensajeUpdate) {
                return response()->json([
                    'success' => true,
                    'message' => "Message not found",
                    'data' => $messageUpdate
                ], 404);
            }
            
            if(isset($Mensaje)){
                $MensajeUpdate->Mensaje = $request->input("message");
            }
            if(isset($from)){
                $MensajeUpdate->from = $request->input("from");
            }
            if(isset($party_id)){
                $MensajeUpdate->party_id = $request->input("party_id");
            }
            if(isset($date)){
                $MensajeUpdate->date = $request->input("date");
            }
            $MensajeUpdate->save();
            return response()->json([
                'success' => true,
                'message' => "message updated succesfully",
                'data ' => $MensajeUpdate
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error updating message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error updating message"
            ], 500);
        }
    }

    public function deleteMensaje($id)
    {
        try{
            Log::info("Deleting message with id " . $id);

            $Mensaje = Mensaje::query()
                ->find($id)
                ->delete();
                
            return response()->json([
                'success' => true,
                'message' => "Message deleted succesfully",
                'data' => $Mensaje
            ], 200);

        }catch(\Exception $exception) {
            Log::error("Error deleting Exception message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting message"
            ], 500);
        }catch(\Throwable $exception){
            Log::error("Error deleting Throwable message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting message"
            ], 500);
        }
    }
}