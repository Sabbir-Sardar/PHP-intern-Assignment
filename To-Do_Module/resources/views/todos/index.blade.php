<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-4">To-Do List</h2>

            <!-- To-Do Creation Form -->
            <div class="mb-4">
                <input type="text" id="task" class="form-control" placeholder="Enter a new to-do">
                <button class="btn btn-primary mt-2" id="addTodo">Create To-Do</button>
            </div>

            <!-- To-Do List Table -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="todoTable">
                @foreach($todos as $todo)
                    <tr id="todo-{{ $todo->id }}">
                        <td>{{ $todo->task }}</td>
                        <td>
                            <button class="btn btn-success completeTodo" data-id="{{ $todo->id }}">Complete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // CSRF Token setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add new To-Do
        $('#addTodo').on('click', function () {
            var task = $('#task').val();
            if (task) {
                $.ajax({
                    url: '/todos',
                    method: 'POST',
                    data: { task: task },
                    success: function (response) {
                        $('#todoTable').append(`
                                <tr id="todo-${response.id}">
                                    <td>${response.task}</td>
                                    <td><button class="btn btn-success completeTodo" data-id="${response.id}">Complete</button></td>
                                </tr>
                            `);
                        $('#task').val(''); // Clear the input field
                    }
                });
            }
        });

        // Mark To-Do as complete and delete from database and UI
        $(document).on('click', '.completeTodo', function () {
            var id = $(this).data('id');
            $.ajax({
                url: `/todos/${id}`,  // Use DELETE method to remove from DB
                method: 'DELETE',
                success: function () {
                    $(`#todo-${id}`).remove(); // Remove the row from the table
                }
            });
        });
    });
</script>
</body>
</html>
