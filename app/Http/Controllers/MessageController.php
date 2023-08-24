<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Models\Message;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->user()->id;
        $mailbox = $request->query('mailbox', 'inbox');

        $query = Message::where('user_id', $userId);

        switch ($mailbox) {
            case 'archived':
                $query = $query->onlyTrashed();
                break;
            case 'sent':
                $query = $query->where('from', $userId);
                break;
            default:
                $query = $query->where('to', $userId);
        }

        $messages = $query->with(['user', 'fromUser', 'toUser'])->get();

        return response()->json($messages);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->validate($request, [
                'subject' => 'required|min:1',
                'content' => 'required|min:1',
                'to' => [
                        'required',
                        'exists:users,id'
                    ]
                ]);

            $message = DB::table('messages')->insert(
                [
                    'user_id' => Auth::id(),
                    'from' => Auth::id(),
                    'to' => $request->to,
                    'subject' => $request->subject,
                    'content' => $request->content,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );

            DB::table('messages')->insert(
                [
                    'user_id' => $request->to,
                    'from' => Auth::id(),
                    'to' => $request->to,
                    'subject' => $request->subject,
                    'content' => $request->content,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );

            DB::commit();
            return response()->json($message, 201);

        } catch (\Exception $e) {
            DB::rollback();
            abort(400, $e->getMessage());
        }
    }

    public function update(Request $request, Message $message)
    {

        if ($message->user_id !== Auth::id()) {
            abort(401, 'Invalid access.');
        }

        if (isset($request->read)) {
            $message->read_at = Carbon::now();
        }

        if (isset($request->recover)) {
            $message->deleted_at = null;    
        }

        $message->save();

        return response()->json($message, 204);
    }

    public function delete(Request $request, Message $message)
    {
        if ($message->user_id !== Auth::id()) {
            abort(401, 'Invalid access.');
        }
    
        $message->delete();   
        return response()->json([
            'success' => true
        ], 200);
    }
}