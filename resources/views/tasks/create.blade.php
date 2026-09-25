<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Task</title>

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
            max-width: 650px;
            margin: 50px auto;
        }

        /* HEADER */
        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 8px 0;
            font-size: 30px;
            color: #222;
        }

        .page-header p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        /* FORM CARD */
        .form-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
        }

        .form-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #222;
        }

        /* LABELS */
        label {
            display: block;
            margin-bottom: 8px;
            margin-top: 18px;
            font-size: 14px;
            font-weight: bold;
            color: #444;
        }

        label:first-of-type {
            margin-top: 0;
        }

        /* INPUTS */
        input,
        textarea,
        select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d5d5d5;
            border-radius: 8px;
            background: #fafafa;
            color: #222;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            background: white;
            border-color: #888;
            box-shadow: 0 0 0 3px rgba(100, 100, 100, 0.08);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* BUTTONS */
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .save-button {
            border: none;
            background: #222;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .save-button:hover {
            background: #444;
        }

        .back-button {
            display: inline-block;
            background: #eeeeee;
            color: #444;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .back-button:hover {
            background: #dddddd;
        }

        /* ERRORS */
        .error {
            background: #f7f7f7;
            border: 1px solid #ccc;
            color: #555;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error strong {
            color: #222;
        }

        .error ul {
            margin-bottom: 0;
        }

        /* MOBILE */
        @media (max-width: 600px) {

            .container {
                width: 92%;
                margin: 30px auto;
            }

            .form-card {
                padding: 22px;
            }

            .buttons {
                flex-direction: column;
            }

            .save-button,
            .back-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <h1>Add New Task</h1>

        <p>
            Create a new task and keep track of your progress.
        </p>

    </div>


    <!-- VALIDATION ERRORS -->
    @if($errors->any())

        <div class="error">

            <strong>Please fix the following:</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- FORM CARD -->
    <div class="form-card">

        <div class="form-title">
            Task Information
        </div>


        <!-- ADD TASK FORM -->
        <form action="/tasks" method="POST">

            @csrf


            <!-- TASK NAME -->
            <label for="task_name">
                Task Name
            </label>

            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ old('task_name') }}"
                placeholder="Enter task name"
                required
            >


            <!-- DESCRIPTION -->
            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                placeholder="Enter task description"
            >{{ old('description') }}</textarea>


            <!-- STATUS -->
            <label for="status">
                Status
            </label>

            <select
                id="status"
                name="status"
                required
            >

                <option
                    value="Pending"
                    {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="Completed"
                    {{ old('status') == 'Completed' ? 'selected' : '' }}
                >
                    Completed
                </option>

            </select>


            <!-- DUE DATE -->
            <label for="due_date">
                Due Date
            </label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ old('due_date') }}"
            >


            <!-- BUTTONS -->
            <div class="buttons">

                <button
                    type="submit"
                    class="save-button"
                >
                    + Add Task
                </button>

                <a
                    href="/"
                    class="back-button"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>