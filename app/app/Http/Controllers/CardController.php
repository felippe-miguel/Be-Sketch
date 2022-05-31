<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\IndexCardRequest;
use App\Http\Requests\Card\StoreCardRequest;
use App\Http\Requests\Card\UpdateCardRequest;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CardController extends Controller
{
    public function index(IndexCardRequest $request): JsonResponse
    {
        if (empty($request->validated())) {
            return response()->json([
                'cards' => Auth::user()->cards->toArray()
            ]);
        }

        $cards = Card::where('column_id', $request->column_id)->get();

        return response()->json([
            'cards' => $cards->values()->toArray()
        ]);
    }

    public function store(StoreCardRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = Auth::id();

        $card = Card::create($data);

        return response()->json([
            'message' => 'Card successfully created',
            'id'      => $card->id
        ], 201);
    }

    public function show(Card $card): JsonResponse
    {
        if (!Gate::allows('card-show', $card)) {
            abort(403);
        }

        return response()->json($card->toArray());
    }

    public function update(UpdateCardRequest $request, Card $card): JsonResponse
    {
        if (!Gate::allows('card-update', $card)) {
            abort(403);
        }

        if (empty($request->validated())) {
            return response()->json(['message' => 'Nothing to update.']);
        }

        $card->fill($request->validated())->save();

        return response()->json(['message' => 'Card successfully updated']);
    }

    public function destroy(Card $card): JsonResponse
    {
        if (!Gate::allows('card-destroy', $card)) {
            abort(403);
        }

        $card->delete();

        return response()->json(['message' => 'Card successfully deleted']);
    }
}
