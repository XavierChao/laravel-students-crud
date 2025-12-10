<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Course</h2>

    <a class="btn btn-primary mb-3" href="{{ route('courses.index') }}">
        Back
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ $course->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" rows="4">{{ $course->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>

    </form>

</div>

</body>
</html>
