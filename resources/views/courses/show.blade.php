<!DOCTYPE html>
<html>
<head>
    <title>Show Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Show Course</h2>

    <a class="btn btn-primary mb-3" href="{{ route('courses.index') }}">
        Back
    </a>

    <div class="card">
        <div class="card-body">

            <p><strong>Name:</strong> {{ $course->name }}</p>
            <p><strong>Description:</strong> {{ $course->description }}</p>

        </div>
    </div>

</div>

</body>
</html>
