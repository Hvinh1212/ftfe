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
    <title>User Add</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>

                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('user.add') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-person-plus"></i> <span class="ms-1 d-none d-sm-inline">Add User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add User</h5>
                    </div>
                    <div class="card-body">
                        <form id="addUserForm" method="post" action="{{ route('user.store') }}">
                            @csrf
                            <div class="space-y">
                                <div class="row row-cols-2 g-4">
                                    <div>
                                        <label class="form-label" for="name">Full Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            placeholder="Enter full name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            placeholder="Enter email"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label" for="user_flg">User flag</label>
                                        <select name="user_flg" id="user_flg"
                                            class="form-select @error('user_flg') is-invalid @enderror">
                                            <option value="">— Select —</option>
                                            <option value="0" @selected(old('user_flg')==='0' || old('user_flg')===0)>Admin (0)</option>
                                            <option value="1" @selected(old('user_flg')==='1' || old('user_flg')===1)>User (1)</option>
                                            <option value="2" @selected(old('user_flg')==='2' || old('user_flg')===2)>Support (2)</option>
                                        </select>
                                        @error('user_flg')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row row-cols-2 g-4 mt-1">
                                    <div>
                                        <label class="form-label" for="datePicker">Date of Birth</label>
                                        <input type="text" name="date_of_birth" id="datePicker"
                                            value="{{ old('date_of_birth') }}" class="form-control @error('date_of_birth') is-invalid @enderror"
                                            autocomplete="off" placeholder="YYYY/MM/DD">
                                        @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row row-cols-2 g-4 mt-1">
                                    <div>
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label" for="password_confirmation">Confirm password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="text-end mt-3">
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="{{ asset('js/user-add.js') }}"></script>

</html>