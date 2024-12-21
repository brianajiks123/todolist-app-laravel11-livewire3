<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Home extends Component
{
    public $show_add_task_modal = false;
    public $show_edit_task_modal = false;
    public $new_task = "";
    public $edit_task = "";

    public function addTask()
    {
        $this->validate([
            "new_task" => "required"
        ]);

        Todo::create([
            "task" => $this->new_task,
        ]);

        $this->reset("new_task");
        $this->reset("show_add_task_modal");
    }

    public function setEditTask($task)
    {
        $this->edit_task = $task;
        $this->show_edit_task_modal = true;
    }

    public function editTask(Todo $todo)
    {
        $this->validate([
            "edit_task" => "required"
        ]);

        $todo->update([
            "task" => $this->edit_task,
        ]);

        $this->reset("edit_task");
        $this->reset("show_edit_task_modal");
    }

    public function toggleStatus(Todo $todo)
    {
        $new_is_done = !$todo->is_done;

        $todo->update([
            "is_done" => $new_is_done
        ]);
    }

    public function deleteTask(Todo $todo)
    {
        $todo->delete();
    }

    public function render()
    {
        return view('livewire.home', ["todos" => Todo::orderBy("is_done")->get()]);
    }
}
