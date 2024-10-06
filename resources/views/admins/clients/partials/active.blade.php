@if(!empty($user->email_verified_at))
   <span class="btn btn-success"> Yes </span>
@else
<span class="btn btn-danger"> No </span>
@endif
