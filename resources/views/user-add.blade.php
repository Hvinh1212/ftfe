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
                                        <label class="form-label" for="full_name">
                                            Full Name
                                        </label>
                                        <input type="text" name="name" id="name" placeholder="Enter full name"
                                            class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label" for="email">
                                            Email
                                        </label>
                                        <input type="email" name="email" id="email" placeholder="Enter email"
                                            class="form-control">
                                    </div>

                                    <div>
                                        <label class="form-label">
                                            User flag
                                        </label>
                                        <div>
                                            <select name="user_flg[]" id="user_flg" class="form-control">
                                                <option value="0">Select User Flag</option>
                                                <option value="1">Admin</option>
                                                <option value="2">User</option>
                                                <option value="3">Support</option>
                                            </select>
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
                                                class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label" for="phone">
                                            Phone
                                        </label>
                                        <input type="text" name="phone" id="phone"
                                            class="form-control">
                                    </div>

                                </div>

                                <div class="row row-cols-2 g-4">
                                    <div>
                                        <label class="form-label" for="datePicker">
                                            Password
                                        </label>

                                        <div>
                                            <input type="password" name="password" id="password"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label" for="re_password">
                                            Re-Password
                                        </label>
                                        <input type="password" name="re_password" id="re_password"
                                            class="form-control">
                                    </div>

                                </div>
                                <div class="text-end mt-3">
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

<script>
    const datePickerEl = document.querySelector('#datePicker');
    const fp = flatpickr(datePickerEl, {
        dateFormat: "Y/m/d"
    });

    const passwordEl = document.querySelector('#password');
    const rePasswordEl = document.querySelector('#re_password');
    rePasswordEl.addEventListener('input', function() {
        if (this.value !== passwordEl.value) {
            rePasswordEl.setCustomValidity('The password and re-password must be the same.');
        } else {
            rePasswordEl.setCustomValidity('');
        }
    });
</script>

</html>