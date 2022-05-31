<?php

namespace App\Http\Controllers;

use App\Http\Requests\Column\IndexColumnRequest;
use App\Http\Requests\Column\StoreColumnRequest;
use App\Http\Requests\Column\UpdateColumnRequest;
use App\Models\Column;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ColumnController extends Controller
{
    public function index(IndexColumnRequest $request): JsonResponse
    {
        if (empty($request->validated())) {
            return response()->json([
                'columns' => Auth::user()->columns->toArray()
            ]);
        }

        $columns = Column::where('board_id', $request->board_id)->get();

        return response()->json([
            'columns' => $columns->values()->toArray()
        ]);
    }

    public function store(StoreColumnRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = Auth::id();

        $column = Column::create($data);

        return response()->json([
            'message' => 'Column successfully created',
            'id'      => $column->id
        ], 201);
    }

    public function show(Column $column): JsonResponse
    {
        if (!Gate::allows('column-show', $column)) {
            abort(403);
        }

        return response()->json($column->toArray());
    }

    public function update(UpdateColumnRequest $request, Column $column): JsonResponse
    {
        if (!Gate::allows('column-update', $column)) {
            abort(403);
        }

        if (empty($request->validated())) {
            return response()->json(['message' => 'Nothing to update.']);
        }

        $column->fill($request->validated())->save();

        return response()->json(['message' => 'Column successfully updated']);
    }

    public function destroy(Column $column): JsonResponse
    {
        if (!Gate::allows('column-destroy', $column)) {
            abort(403);
        }

        $column->delete();

        return response()->json(['message' => 'Column successfully deleted']);
    }
}
