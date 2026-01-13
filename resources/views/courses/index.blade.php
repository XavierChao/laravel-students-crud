<!DOCTYPE html>
<html>
<head>
    <title>Courses CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('students.index') }}">Students CRUD</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ route('students.index') }}">Students</a>
            <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
        </div>
        <div class="navbar-nav">
            <span class="nav-link text-light">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">Courses List</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('courses.create') }}" class="btn btn-success mb-3">
        Create New Course
    </a>
    <a href="{{ route('courses.export') }}" class="btn btn-primary mb-3">
        Export to CSV
    </a>
    <a href="{{ route('courses.exportWithStudents') }}" class="btn btn-secondary mb-3">
        Export Courses with Students
    </a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($courses as $course)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->description }}</td>
            <td>
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('courses.show', $course->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('courses.edit', $course->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $courses->links() !!}

</div>

</body>
</html>
