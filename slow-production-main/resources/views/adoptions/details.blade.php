@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Adopt me
                    </div>
                    <div class="card-body">
                        <h2 class="pet-name"><?php echo $adoption->name ?></h2>
                        <p class="pet-description"><?php echo $adoption->description ?></p>
                        <p>Listed by: <b><?php echo $adoption->listedBy->name ?></b></p>
                        <!-- Task 6 User, step 4: this form should not appear if the pet was already adopted -->
                        <?php
                        if ($adoption->listed_by != auth()->id() && auth()->check() && $adoption->adopted_by == null) {
                            echo "<form method='post' action=".route('adoptions.adopt', [$adoption->id]).">";
                                    echo csrf_field();
                                    echo "<button type='submit' class='btn btn-success pet-adopt'>Adopt Now</button>";
                            echo "</form>";
                        }
                        
                        if ($adoption->adopted_by != null) {
                            if ($adoption->adopted_by == auth()->id()) {
                                echo "<p class='text-success'>This pet has been adopted by you :)</p>";
                            } else {
                                echo "<p class='text-danger'>This pet has already been adopted.</p>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-6"></div>
                <div class="ratio ratio-1x1 ">
                    <img src="{{ asset($adoption->image_path) }}" class="card-img-top border border-2 border-dark rounded-3" style="object-fit: cover" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
