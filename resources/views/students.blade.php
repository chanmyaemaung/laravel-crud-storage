<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="main_content">
        <div class="container">
            <div class="row mt-5">
                {{-- Show Success Alert --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Student Form -->
                <div class="col-md-4">
                    <div class="card" style="width: 25rem;">
                        <div class="card-header">
                            Add Student
                        </div>
                        <ul class="list-group list-group-flush p-3">
                            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Student Image</label>
                                    <input type="file" class="form-control" name="photo" />
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Student Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="form-control" value="Submit" />
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>

                <!-- Show All Results -->
                <div class="col-md-8">
                    <div class="card" style="width: 100%;">
                        <div class="card-header">
                            All Students
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Student Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($all_students as $key => $item)
                                <tr>
                                    <th scope="row">
                                        {{-- {{ $key + 1 }} --}}
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        <img src={{ asset('uploads/' . $item -> photo) }} alt={{ $item -> name }} width="100px" />
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="{{ route('edit', $item -> id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete', $item -> id) }}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this student?');">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
