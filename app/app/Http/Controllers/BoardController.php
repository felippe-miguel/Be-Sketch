<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\StoreBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;
use App\Models\Board;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BoardController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'boards' => Auth::user()->boards->toArray()
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
        if (!Gate::allows('board-show', $board)) {
            abort(403);
        }

        return response()->json($board->toArray());
    }

    public function update(UpdateBoardRequest $request, Board $board): JsonResponse
    {
        if (!Gate::allows('board-update', $board)) {
            abort(403);
        }

        if (empty($request->validated())) {
            return response()->json(['message' => 'Nothing to update.']);
        }

        $board->fill($request->validated())->save();

        return response()->json(['message' => 'Board successfully updated']);
    }

    public function destroy(Board $board): JsonResponse
    {
        if (!Gate::allows('board-destroy', $board)) {
            abort(403);
        }

        $board->delete();

        return response()->json(['message' => 'Board successfully deleted']);
    }
}
