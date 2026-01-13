<!DOCTYPE html>
<html>
<head>
    <title>Students CRUD</title>
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

    <h2 class="mb-4">Students List</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">
        Create New Student
    </a>
    <a href="{{ route('students.export') }}" class="btn btn-primary mb-3">
        Export to CSV
    </a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Course</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($students as $student)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->course ? $student->course->name : 'No assigned' }}</td>
            <td>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('students.show', $student->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('students.edit', $student->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $students->links() !!}

</div>

</body>
</html>
