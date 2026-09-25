<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            color: #222;
        }

        .container {
            width: 90%;
            max-width: 950px;
            margin: 45px auto;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .profile-icon {
            width: 42px;
            height: 42px;
            border: 2px solid #555;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #555;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #222;
        }

        /* ADD BUTTON */
        .add-section {
            margin-bottom: 30px;
        }

        .add-button {
            display: inline-block;
            background: #222;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-button:hover {
            background: #444;
        }

        /* STAT CARDS */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.06);
        }

        .stat-number {
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .stat-label {
            font-size: 14px;
            color: #666;
        }

        .total-number {
            color: #222;
        }

        .pending-number {
            color: #d97706;
        }

        .completed-number {
            color: #16a34a;
        }

        /* SECTION */
        .section-title {
            font-size: 20px;
            margin: 0 0 15px 0;
            color: #222;
        }

        /* TASK CARD */
        .task-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 24px 18px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: 0.2s;
        }

        .task-card:hover {
            border-color: #aaa;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
        }

        .task-left {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            min-width: 0;
        }

        /* CHECKBOX */
        .task-checkbox {
            width: 18px;
            height: 18px;
            margin-top: 3px;
            cursor: pointer;
        }

        .task-info {
            min-width: 0;
        }

        .task-name {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            margin-bottom: 7px;
        }

        .task-description {
            font-size: 13px;
            color: #777;
            margin-bottom: 5px;
        }

        .task-date {
            font-size: 13px;
            color: #777;
        }

        /* COMPLETED TASK */
        .completed-card {
            background: #f7faf7;
            border-color: #d9ead9;
        }

        .completed-card .task-name {
            color: #777;
            text-decoration: line-through;
        }

        /* ACTIONS */
        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-left: 15px;
        }

        .icon-button {
            width: 38px;
            height: 38px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 9px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #555;
            font-size: 16px;
            transition: 0.2s;
        }

        .icon-button:hover {
            background: #f0f0f0;
            border-color: #bbb;
        }

        .delete-button:hover {
            color: #b91c1c;
            border-color: #e5bebe;
            background: #fff5f5;
        }

        /* EMPTY */
        .empty-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 35px;
            text-align: center;
            color: #777;
        }

        /* SUCCESS MESSAGE */
        .success {
            background: #eeeeee;
            border: 1px solid #d5d5d5;
            color: #444;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {

            .container {
                width: 92%;
                margin: 30px auto;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .task-card {
                align-items: flex-start;
            }

            .actions {
                flex-direction: column;
            }

            .header h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="profile-icon">
            ♙
        </div>

        <h1>Personal Task Manager</h1>

    </div>


    <!-- ADD TASK -->
    <div class="add-section">

        <a href="/tasks/create" class="add-button">
            + &nbsp; Add New Task
        </a>

    </div>


    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @php
        $totalTasks = $tasks->count();
        $pendingTasks = $tasks->where('status', 'Pending');
        $completedTasks = $tasks->where('status', 'Completed');
    @endphp


    <!-- STATISTICS -->
    <div class="stats">

        <div class="stat-card">

            <div class="stat-number total-number">
                {{ $totalTasks }}
            </div>

            <div class="stat-label">
                Total Tasks
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-number pending-number">
                {{ $pendingTasks->count() }}
            </div>

            <div class="stat-label">
                Pending
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-number completed-number">
                {{ $completedTasks->count() }}
            </div>

            <div class="stat-label">
                Completed
            </div>

        </div>

    </div>


    <!-- PENDING TASKS -->
    <h2 class="section-title">
        Pending Tasks
    </h2>


    @if($pendingTasks->count() > 0)

        @foreach($pendingTasks as $task)

            <div class="task-card">

                <div class="task-left">

                    <form
                        action="/tasks/{{ $task->id }}/status"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="checkbox"
                            class="task-checkbox"
                            onchange="this.form.submit()"
                        >

                    </form>


                    <div class="task-info">

                        <div class="task-name">
                            {{ $task->task_name }}
                        </div>

                        @if($task->description)

                            <div class="task-description">
                                {{ $task->description }}
                            </div>

                        @endif

                        @if($task->due_date)

                            <div class="task-date">
                                Due: {{ $task->due_date }}
                            </div>

                        @endif

                    </div>

                </div>


                <div class="actions">

                    <!-- EDIT -->
                    <a
                        href="/tasks/{{ $task->id }}/edit"
                        class="icon-button"
                        title="Edit Task"
                    >
                        ✎
                    </a>


                    <!-- DELETE -->
                    <form
                        action="/tasks/{{ $task->id }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="icon-button delete-button"
                            title="Delete Task"
                            onclick="return confirm('Are you sure you want to delete this task?')"
                        >
                            ♙
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty-card">
            No pending tasks.
        </div>

    @endif



    <!-- COMPLETED TASKS -->

    <h2 class="section-title" style="margin-top: 30px;">
        Completed Tasks
    </h2>


    @if($completedTasks->count() > 0)

        @foreach($completedTasks as $task)

            <div class="task-card completed-card">

                <div class="task-left">

                    <form
                        action="/tasks/{{ $task->id }}/status"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="checkbox"
                            class="task-checkbox"
                            checked
                            onchange="this.form.submit()"
                        >

                    </form>


                    <div class="task-info">

                        <div class="task-name">
                            {{ $task->task_name }}
                        </div>

                        @if($task->description)

                            <div class="task-description">
                                {{ $task->description }}
                            </div>

                        @endif

                        @if($task->due_date)

                            <div class="task-date">
                                Completed: {{ $task->due_date }}
                            </div>

                        @endif

                    </div>

                </div>


                <div class="actions">

                    <!-- DELETE -->
                    <form
                        action="/tasks/{{ $task->id }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="icon-button delete-button"
                            title="Delete Task"
                            onclick="return confirm('Are you sure you want to delete this task?')"
                        >
                            ♙
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty-card">
            No completed tasks.
        </div>

    @endif

</div>

</body>
</html>