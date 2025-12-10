<!DOCTYPE html>
<html>
<head>
    <title>Show Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Show Student</h2>

    <a class="btn btn-primary mb-3" href="{{ route('students.index') }}">
        Back
    </a>

    <div class="card">
        <div class="card-body">

            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Age:</strong> {{ $student->age }}</p>
            <p><strong>Course:</strong> {{ $student->course ? $student->course->name : 'No assigned' }}</p>

        </div>
    </div>

</div>

</body>
</html>
