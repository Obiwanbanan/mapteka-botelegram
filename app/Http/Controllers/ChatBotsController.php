<?php

namespace App\Http\Controllers;

use App\Handler\ChatBotsHandler;
use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatBotsController extends Controller
{
    public function index(): View
    {
        $bots = Bot::all();

        return view('chatBots/index', [
            'chatBots' => $bots,
            'choiceBot' => $bots[0] ?? null,
        ]);
    }

    public function add(
        Request $request,
        ChatBotsHandler $chatBotsHandler,
    ): View|JsonResponse {
        if ($request->isMethod('post')) {
            $handelAdd = $chatBotsHandler->add($request);

            if (!$handelAdd['status']) {
                return response()->json($handelAdd);
            }

            return response()->json([
                'status' => true,
                'url' => route('chat-bots'),
            ]);
        }

        return view('chatBots/add');
    }

    public function update(
        Request $request,
        ChatBotsHandler $chatBotsHandler,
    ): JsonResponse {
        return response()->json($chatBotsHandler->update($request));
    }

    public function remove(
        Request $request,
        ChatBotsHandler $chatBotsHandler,
    ): JsonResponse {
        return response()->json($chatBotsHandler->remove($request));
    }
}
