@extends('dashboard.layouts.app')

@push('title','User Profile')

@push('styles')
    <link href="{{asset(ASSET_PATH.'/assets/css/profile.css')}}"
          rel="stylesheet"/>
@endpush
@section('content')
    <!-- Modal -->
    <div class="modal" id="staticBackdrop">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content top-video-modal ">
                <div class="modal-body video-modal">
                    <iframe id="videoIframe" width="100%" height="400" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--End Model -->
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-4">
                            @if(!empty($user->image))
                                <img
                                    src="{{ url('public/uploads/users/avatars') . 'profile.blade.php/' . $user->image}}"
                                    style="height: 50px" alt="" class="img-thumbnail rounded-circle">
                            @else
                                <img src="{{ url('assets/images/default_user.png')}}" style="height: 50px" alt=""
                                     class="img-thumbnail rounded-circle">
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-muted">
                                <h5>{{$user->first_name}} {{$user->last_name}}</h5>
                                <p class="mb-1">{{$user->email}}</p>
                                <p class="mb-0">{{$user->details}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class='fa fa-coins'></i>
                                    </div>

                                    <p class="text-muted mb-2">Couns</p>
                                    <h5>{{$user->coins_count}}</h5>


                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-import"></i>
                                    </div>

                                    <p class="text-muted mb-2">Flowers</p>
                                    <h5>{{$user->followers}}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-send"></i>
                                    </div>

                                    <p class="text-muted mb-2">Followings</p>
                                    <h5>{{$user->followings}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="sidebar">
                        <li class="active" >
                            <a href="{{route('dashboard.admins.profile_videos' , $user->id )}}"><span><i class="fa fa-coins"></i> </span> Videos </a>
                        </li>
                        <li>
                            <span><i class="fa fa-coins"></i> </span>
                            <a href="{{route('dashboard.admins.profile_videos' , $user->id )}}"><span><i class="fa fa-question"></i> </span> Videos </a>
                        </li>

                        <li>
                            <span><i class="fa fa-coins"></i> </span>
                            <a href="#">Comments </a>
                        </li>

                        <li>
                            <span><i class="fa fa-coins"></i> </span>
                            <a href="#">Coins </a>
                        </li>
                        <li>
                            <span><i class="fa fa-coins"></i> </span>
                            <a href="#">Videos </a>
                        </li>
                        <li>
                            <span><i class="fa fa-coins"></i> </span>
                            <a href="#">Videos </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function updateIframeSrc(newSrc) {
            var modalElement = document.getElementById('staticBackdrop');
            var iframeElement = modalElement.querySelector('iframe');

            // Check if the modal is shown
            if (modalElement.classList.contains('show')) {
                // Update the src of the iframe
                iframeElement.src = newSrc;
            }
        }
        // Add an event listener for the modal hide event
        // Add an event listener for the modal hide event
        var modalElement = document.getElementById('staticBackdrop');
        modalElement.addEventListener('hidden.bs.modal', function () {
            var iframeElement = document.getElementById('videoIframe');
            // Reset the src attribute to stop the video
            iframeElement.src = "";
        });
    </script>



    <script>
        $(document).on('click', '#is_confirmed', function () {

            var item_id = $(this).parents('.switch').find('.item_id').val();
            $.ajax({
                url: "{{route('dashboard.video.confirm')}}?id=" + item_id,
                method: "post",
                data: {id: item_id , _token: '{{ csrf_token() }}'},
                success: function (e) {
                    if (e.status) {
                        Swal.fire({
                            title: 'Confirmed',
                            icon: "success",
                            showCancelButton: 0,
                            confirmButtonColor: "green",
                            cancelButtonColor: "red",
                        }).then((result) => {
                            if (result.value) {

                            }
                        });
                    }
                }
            });

        });

    </script>
@endpush











