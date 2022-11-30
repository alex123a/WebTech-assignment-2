@extends('master')

@section('content')
    <div class="h-100" style="background-image: url(' <?php echo asset('imgs/login.jpg') ?>'); background-size: cover; position: relative">
        <div style="position: absolute;background-color: black;height: 100%;width: 100%;opacity: 50%"></div>
        <div class="card shadow-sm" style="width: 500px; top: 50%;left: 50%;  transform: translate(-50%, -50%);position: absolute">
            <div class="card-header">
                <h3 class="mb-0">Register</h3>
            </div>
            <div class="card-body"></div>
                <!-- Task 2 Guest, step 5: add the HTTP method and url as instructed-->
                <form method="POST" action=<?php echo route("doRegister") ?>>
                    <?php echo csrf_field() ?>
                    <!-- Task 2 Guest, step 3: add register fields as instructed-->
                    <!-- Tip: we add the element name for you as an inspiration on how you can add the rest of the inputs -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control name" id="name" value=<?php echo old('name') ?>>
                        <?php
                            if ($errors->has('name')) {
                                echo "<div class='form-text text-danger'>".$errors->first('name')."</div>";
                            }
                        ?>
                        <label class="form-label">email</label>
                        <input class="form-control email" name = "email"></input>
                        <?php
                            if ($errors->has('email')) {
                                echo "<div class='form-text text-danger'>".$errors->first('email')."</div>";
                            }
                        ?>
                        <label class="form-label">Password</label>
                        <input class="form-control password" type="password" name = "password"></input>
                        <label class="form-label">Confirm password</label>
                        <input class="form-control password-confirmation" type="password" name="password_confirmation"></input>
                        <?php
                            if ($errors->has('password')) {
                                echo "<div class='form-text text-danger'>".$errors->first('password')."</div>";
                            }
                        ?>
                    </div>
                    <!-- end of Tip -->

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Task 2 Guest, step 4: add submit button-->
                        <button type="submit" class="btn btn-primary register-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
