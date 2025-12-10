<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Add New Course</h2>

    <a class="btn btn-primary mb-3" href="{{ route('courses.index') }}">
        Back
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> There were some problems.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Course Name">
        </div>

        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" placeholder="Course Description" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

    </form>

</div>

</body>
</html>
