<div class="grid place-content-center h-screen gap-4 px-3">
    <h1 class="text-center">Simple Todolist App</h1>

    <ul class="menu menu-vertical bg-base-200">
        @forelse ($todos as $todo)
            <li>
                <div @class(['line-through' => $todo->is_done])>
                    <div wire:click="toggleStatus({{ $todo->id }})">{{ $todo->task }}</div>
                    <button class="badge badge-sm badge-warning" wire:click="setEditTask('{{ $todo->task }}')">Edit</button>
                    <button class="badge badge-sm badge-error"
                        wire:click="deleteTask({{ $todo->id }})">DELETE</button>
                </div>
            </li>
        @empty
            <li>
                <div>Task is empty.</div>
            </li>
        @endforelse
    </ul>

    <!-- Add Task Modal -->
    <button class="btn" wire:click="$set('show_add_task_modal', 1)">Add Task</button>
    <dialog id="add_task_modal" class="modal" {{ $show_add_task_modal ? 'open' : '' }} data-theme="light">
        <form class="modal-box" wire:submit="addTask">
            <h3 class="text-lg font-bold">Add New Task</h3>

            <div class="py-3">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">What is your task?</span>
                    </div>
                    <input type="text" placeholder="Type here" @class([
                        'input input-bordered w-full',
                        'input-error' => $errors->first('new_task'),
                    ]) wire:model="new_task" />
                    @error('new_task')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
            </div>

            <div class="modal-action">
                <button type="button" class="btn" wire:click="$set('show_add_task_modal', 0)">Close</button>
                <button class="btn btn-success">Add Task</button>
            </div>
        </form>
    </dialog>

    <!-- Edit Modal -->
    <dialog id="edit_task_modal" class="modal" {{ $show_edit_task_modal ? 'open' : '' }} data-theme="light">
        <form class="modal-box" wire:submit="editTask({{ $todo->id }})">
            <h3 class="text-lg font-bold">Edit Task</h3>

            <div class="py-3">
                <label class="form-control w-full">
                    <input type="text" value="{{ $edit_task }}" placeholder="Type here"
                        @class([
                            'input input-bordered w-full',
                            'input-error' => $errors->first('edit_task'),
                        ]) wire:model="edit_task" />
                    @error('edit_task')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
            </div>

            <div class="modal-action">
                <button type="button" class="btn" wire:click="$set('show_edit_task_modal', 0)">Close</button>
                <button class="btn btn-primary">Update Task</button>
            </div>
        </form>
    </dialog>
</div>
