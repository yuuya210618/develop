<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;  // 追加するのを忘れない

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        return view('tasks.index');
    }
}
