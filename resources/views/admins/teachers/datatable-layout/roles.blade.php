@forelse($admin->getRoleNames() as $role)
    <span class="btn btn-primary btn-sm">{{ $role }}</span>
@empty
    <span class="btn btn-danger btn-sm">No Role</span>
@endforelse
