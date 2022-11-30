@extends('master')

@section('content')
    <div class="container mt-4">
        <h2> <?php echo $header ?> </h2>
        @include('partials.success-alert')
        <div class="row">
            <?php 
                if (!empty($adoptions)) {
                    foreach($adoptions as $adoption) {
                        ?>
                        <div class="col-4 pet">
                            @include('adoptions.partials.card', ['adoption' => $adoption])
                        </div>
                        <?php
                    }
                } else {
                    echo "<h2>This list is empty</h2>";
                }
            ?>
        </div>
    </div>
@endsection
