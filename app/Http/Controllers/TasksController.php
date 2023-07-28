<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;  // 追加するのを忘れない

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('updated_at', 'desc')->get();
        return view('tasks.index');
    }

    public function show($id)
    {
        return view('tasks.show');
    }

    public function add()
    {
        return view('tasks.add');
    }

    public function store(TaskRequest $request)
    {
        // tasksテーブルにフォームで入力した値を挿入する
        $result = Task::create([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }
    
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));;
    }

    public function update(TaskRequest $request, $id)
    {
        // idを条件にtasksテーブルからレコードを取得
        $task = Task::find($id);
        // 更新処理
        $task->fill([
            'name' => $request->name,
            'content' => $request->content,
        ])
        ->save();

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }

    public function delete($id)
    {
        // idを条件にtasksテーブルから該当レコードを削除
        $task = Task::destroy($id);

        // タスク一覧画面にリダイレクト
        return redirect()->route('tasks.index');
    }
}
