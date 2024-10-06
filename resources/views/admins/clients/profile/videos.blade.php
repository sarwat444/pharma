@extends('dashboard.layouts.app')

@push('title','User Profile')

@push('styles')
    @push('styles')

        <link href="{{asset(ASSET_PATH.'/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
              rel="stylesheet" type="text/css"/>
        <link href="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
              rel="stylesheet" type="text/css"/>
        <link href="{{asset(ASSET_PATH.'/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    @endpush
    <link href="{{asset(ASSET_PATH.'/assets/css/profile.css')}}"
          rel="stylesheet"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-4">
                            @if(!empty($user->image))
                                <img
                                    src="{{ url($user->image)}}"
                                    style="height: 50px" alt="" >
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
                        <li class="active">

                            <a href="{{route('dashboard.admins.profile_videos' , $user->id )}}"><span><i class="fa fa-coins"></i> </span> Videos </a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.admins.profile_questions' , $user->id )}}"><span><i class="fa fa-question"></i> </span>  Questions </a>
                        </li>

                        <li>
                            <span><i class="fa fa-coins"></i> </span>
                            <a href="#">Questions </a>
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
                    <div class="card Audios_card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('dashboard.videos') }}</h4>
                            <div class="table-responsive">
                                <table data-orderable="0" data-orderable_type="desc"  id="videos-datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('dashboard.image') }}</th>
                                        <th scope="col"> Catrgory </th>
                                        <th scope="col"> Caption </th>
                                        <th scope="col"> Confirmed </th>
                                        <th scope="col">{{ __('dashboard.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                      @forelse($videos as $video)
                                          <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td><img src="{{$video->avatar}}" class="img-thumbnail" style="height: 75px" > </td>
                                              <td>{{$video->category->name}}</td>
                                              <td>{{$video->caption ?? 'No Caption'}}</td>
                                              <td>@if($video->is_confirmed == 0 ) <span class="text-danger badge badge-soft-danger"> Not Confirmed </span> @else <span class="text-success badge badge-soft-success">  Confirmed </span> @endif</td>
                                              <td>
                                                  <a href="{{route('dashboard.showVideo' ,$video->id )}}" class="text-primary" style="border: 0; background-color: transparent; margin-right: 10px;">
                                                      <i class="fa fa-eye"></i>
                                                  </a>
                                                  <button class="text-primary" style="border: 0; background-color: transparent; margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="updateIframeSrc('{{$video->video}}')">
                                                      <i class="fa fa-play"></i>
                                                  </button>
                                              </td>
                                          </tr>
                                          @empty
                                          <tr><td colspan="6">No Videos Found</td> </tr>
                                      @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/js/pages/sweet-alerts.init.js')}}"></script>
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
        $(document).ready(function (){
            $('#videos-datatable').DataTable() ;
        });
    </script>
@endpush
