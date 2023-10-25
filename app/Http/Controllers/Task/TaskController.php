<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {

        $userId = Auth::id();


        try {
            $tasks = Task::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return response()->json($tasks, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'priority_id' => 'required',
            'status_id' => 'required',
        ]);

        $userId = Auth::id();


        try {
            $task = new Task();

            $task->title = $request->title;
            $task->description = $request->description;
            $task->date = $request->date;
            $task->time = $request->time;
            $task->priority_id = $request->priority_id;
            $task->status_id = $request->status_id;
            $task->user_id = $userId;

            $task->save();
            return response()->json($task, 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Erro ao criar tarefa!', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(string $task_id): JsonResponse
    {

        try {
            $task = Task::find($task_id);

            return response()->json($task, 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Erro ao buscar tarefa!', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, string $task_id): JsonResponse
    {


        $task = Task::findOrFail($task_id);

        if (Auth::user()->id !== $task->user_id) {
            return response()->json(['message' => 'Você não tem permissão para atualizar esta tarefa.'], 403);
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'priority_id' => 'required',
            'status_id' => 'required',
        ]);

        try {
            $task = Task::findOrFail($task_id);

            $task->title = $request->title;
            $task->description = $request->description;
            $task->date = $request->date;
            $task->time = $request->time;
            $task->priority_id = $request->priority_id;
            $task->status_id = $request->status_id;

            $task->save();

            return response()->json(['message' => 'Tarefa atualizada com sucesso.'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Erro ao atualizar tarefa', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $task_id): JsonResponse
    {

        $task = Task::findOrFail($task_id);

        if (Auth::user()->id !== $task->user_id) {
            return response()->json(['message' => 'Você não tem permissão para excluir esta tarefa.'], 403);
        }

        try {
            $Task = Task::destroy($task_id);

            return response()->json(['message' => 'Tarefa excluída com sucesso'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao excluir tarefa'], 500);
        }
    }
}
