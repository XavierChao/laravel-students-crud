<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Add New Student</h2>

    <a class="btn btn-primary mb-3" href="{{ route('students.index') }}">
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

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>

        <div class="mb-3">
            <label>Age:</label>
            <input type="number" name="age" class="form-control" placeholder="Age">
        </div>

        <div class="mb-3">
            <label>Course:</label>
            <select name="course_id" class="form-control">
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

    </form>

</div>

</body>
</html>
