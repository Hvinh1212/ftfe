<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span
                                    class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Item</span> 1 </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Item</span> 2 </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span
                                    class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Item</span> 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 2</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 3</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">loser</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Example Form
                        </h3>
                    </div>
                    <div class="card-body">

                        <form id="searchForm" method="get" action="{{ route('users.index') }}">
                            <input type="hidden" name="search" value="1">
                            <div class="space-y">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>
                                        Personal Info
                                    </h4>
                                    <a href="{{ route('user.add') }}" class="btn btn-primary">Add User</a>
                                </div>

                                <div class="row row-cols-2 g-4">
                                    <div>
                                        <label class="form-label" for="full_name">
                                            Full Name
                                        </label>
                                        <input type="text" name="full_name" id="full_name"
                                            value="{{ request('full_name') }}" placeholder="Enter first name"
                                            class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label" for="email">
                                            Email
                                        </label>
                                        <input type="text" name="email" id="email"
                                            value="{{ request('email') }}" placeholder="Enter email"
                                            class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">
                                            User flag
                                        </label>
                                        <div>
                                            @php
                                            if (!request()->has('user_flg')) {
                                            $userFlg = ['0', '1', '2'];
                                            } else {
                                            $userFlg = request('user_flg');
                                            }
                                            @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="user_flg[]" value="0"
                                                    {{ in_array('0', $userFlg) ? 'checked' : '' }}>
                                                <label class="form-check-label">Admin (0)</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="user_flg[]" value="1"
                                                    {{ in_array('1', $userFlg) ? 'checked' : '' }}>
                                                <label class="form-check-label">User (1)</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="user_flg[]" value="2"
                                                    {{ in_array('2', $userFlg) ? 'checked' : '' }}>
                                                <label class="form-check-label">Support (2)</label>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row row-cols-2 g-4">
                                    <div>
                                        <label class="form-label" for="datePicker">
                                            Date of Birth
                                        </label>

                                        <div>
                                            <input type="text" name="date_of_birth" id="datePicker"
                                                value="{{ request('date_of_birth') }}" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label" for="phone">
                                            Phone
                                        </label>
                                        <input type="text" name="phone" id="phone" value="{{ request('phone') }}"
                                            class="form-control">
                                    </div>

                                </div>
                                <div class="text-end mt-3">
                                    <button type="button" class="btn btn-outline-primary" id="btnClearForm">Clear</button>
                                    <button type="submit" class="btn btn-outline-primary" name="export" value="1">Export CSV</button>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card mt-5 @if ($records->isEmpty()) d-none @endif">
                    <div class="card-body">
                        <!-- php artisan vendor:publish --tag=laravel-pagination -->
                        @if ($records->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Showing {{ $records->firstItem() }} to {{ $records->lastItem() }} of {{ $records->total() }} results
                            </div>
                            <div>
                                {{ $records->links() }}
                            </div>

                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 3rem;">Acton</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">User flag</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                    <tr>
                                        <td colspan="2" class="d-flex gap-2">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-warning">Edit</button>
                                        </td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->email }}</td>
                                        <td>{{ $record->user_flg }}</td>
                                        <td>{{ $record->date_of_birth?->format('Y/m/d') ?? '-' }}</td>
                                        <td>{{ $record->phone ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</body>

<script>
    const datePickerEl = document.querySelector('#datePicker');
    const fp = flatpickr(datePickerEl, {
        dateFormat: "Y/m/d"
    });

    document.getElementById('btnClearForm').addEventListener('click', function() {
        document.getElementById('full_name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('phone').value = '';
        fp.clear();
        document.querySelectorAll('#searchForm input[name="user_flg[]"]').forEach(function(cb) {
            cb.checked = true;
        });
    });
</script>

</html>