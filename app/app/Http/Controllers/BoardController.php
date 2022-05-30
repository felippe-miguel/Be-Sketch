<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function index(): JsonResponse
    {
        $boards = Board::where('user_id', Auth::id())->get();

        return response()->json([
            'boards' => $boards->values()->toArray()
        ]);
    }

    public function store(StoreBoardRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = Auth::id();

        $board = Board::create($data);

        return response()->json([
            'message' => 'Board successfully created',
            'id'      => $board->id
        ], 201);
    }

    public function show(Board $board): JsonResponse
    {
        //
    }

    public function update(Request $request, Board $board): JsonResponse
    {
        //
    }

    public function destroy(Board $board): JsonResponse
    {
        //
    }
}
