<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Task Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        #drop-zone {
            margin-top: 10px;
            padding: 20px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            text-align: center;
            color: #aaa;
            cursor: pointer;
        }
        #drop-zone.dragover {
            border-color: #66afe9;
            background-color: #f0f8ff;
        }
        #file-input {
            display: none;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @yield('dashboard');
    @if ($message=Session::get('success'))
        <div>
            <strong>{{ $message }}</strong>
        </div>
        
    @endif
    <h1>Edit {{$todo->name}}</h1>
    <form id="task-form" method="post" action="/todo/{{$todo->id}}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="task-name">Name</label>
            <input type="text" id="task-name" name="task_name" placeholder="Enter task name" value="{{ old('name', $todo->name) }}" required>
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter task description" required>{{ old('description', $todo->description) }}</textarea>
        </div>
    
        <div class="form-group">
            <label for="photo">Photo</label>
            <div id="drop-zone">Drag & drop a photo here or click to upload</div>
            <input type="file" id="file-input" name="photo" accept="image/*">
        </div>
    
        <div class="form-group">
            <label>Status</label>
            <strong id="status-label">{{ $todo->completed ? 'Completed' : 'Pending' }}</strong>
            <input type="hidden" id="completed-input" name="completed" value="{{ $todo->completed }}">
            <button type="button" id="toggle-status" class="btn btn-warning">
                Mark as {{ $todo->completed ? 'Pending' : 'Completed' }}
            </button>
        </div>      
        <button type="submit">Submit</button>
    </form>
    
    <script>
    document.getElementById('toggle-status').addEventListener('click', function () {
        const completedInput = document.getElementById('completed-input');
        const statusLabel = document.getElementById('status-label');
        const button = this;

        // Toggle the value
        const isCompleted = completedInput.value === '1';
        completedInput.value = isCompleted ? 0 : 1;

        // Update the UI
        statusLabel.textContent = isCompleted ? 'Pending' : 'Completed';
        button.textContent = `Mark as ${isCompleted ? 'Completed' : 'Pending'}`;
    });

        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');

        // Highlight drop zone on dragover
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        // Remove highlight on dragleave
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        // Handle file drop
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files; // Assign dropped files to the input
                alert(`File "${files[0].name}" added.`);
            }
        });

        // Handle click to trigger file input
        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        // Show file name on file selection
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                alert(`File "${fileInput.files[0].name}" selected.`);
            }
        });
    </script>
</body>
</html>
