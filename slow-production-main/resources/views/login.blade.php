@extends('master')

@section('content')
    <div
        style="background-image: url('<?php echo asset('imgs/login.jpg') ?>'); background-size: cover; position: relative"
        class="h-100">
        <div style="position: absolute;background-color: black;height: 100%;width: 100%;opacity: 50%"></div>
        <div class="card shadow-sm"
            style="width: 500px; top: 50%;left: 50%;  transform: translate(-50%, -50%);position: absolute">
            <div class="card-header">
                <h3 class="mb-0">Login</h3>
            </div>
            <div class="card-body">
                <!-- Task 3 Guest, step 5: add the HTTP method and url as instructed-->
                <form method="POST" action=<?php echo route("doLogin") ?>>
                    <?php echo csrf_field() ?>
                    <!-- Task 3 Guest, step 3: add login fields as instructed-->
                    <label class="form-label">Email</label>
                    <input class="form-control email" name = "email"></input>
                    <label class="form-label">Password</label>
                    <input class="form-control password" name = "password" type = "password"></input>

                    <!-- Tip: you can use the same style as the registration form -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary login-submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
