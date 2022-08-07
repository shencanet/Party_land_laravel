<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function getAllMessages()
    {
        try {
            Log::info("Getting all messages");
            $messages = Mensaje::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all messages retrieved.",
                'data' => $messages
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting messages: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting messages"
            ], 500);
        }
    }

    public function getMessageById($id)
    {
        try {
            Log::info("Getting message with id " . $id);
            $message = Mensaje::query()->find($id);
            if (!$message) {
                return response()->json([
                    'success' => true,
                    'message' => "Message not found",
                    'data' => $message
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Get message by id.",
                'data' => $message
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
            $newMessage = new Mensaje();
            $newMessage->message = $request->input("message");
            $newMessage->from = $request->input("from");
            $newMessage->party_id = $request->input("party_id");
            $newMessage->date = $request->input("date");
            $newMessage->save();
            return response()->json([
                'success' => true,
                'message' => "Message created.",
                'data' => $newMessage
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
            $message = $request->input("message");
            $from = $request->input("from");
            $party_id = $request->input("party_id");
            $date = $request->input("date");

            $messageUpdate = Mensaje::query()->find($id);
            if (!$messageUpdate) {
                return response()->json([
                    'success' => true,
                    'message' => "Message not found",
                    'data' => $messageUpdate
                ], 404);
            }
            
            if(isset($message)){
                $messageUpdate->message = $request->input("message");
            }
            if(isset($from)){
                $messageUpdate->from = $request->input("from");
            }
            if(isset($party_id)){
                $messageUpdate->party_id = $request->input("party_id");
            }
            if(isset($date)){
                $messageUpdate->date = $request->input("date");
            }
            $messageUpdate->save();
            return response()->json([
                'success' => true,
                'message' => "message updated succesfully",
                'data ' => $messageUpdate
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

            $message = Mensaje::query()
                ->find($id)
                ->delete();
                
            return response()->json([
                'success' => true,
                'message' => "Message deleted succesfully",
                'data' => $message
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