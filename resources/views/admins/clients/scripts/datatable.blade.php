<script>
    $('.admins-datatable').DataTable({
        processing: true,
        serverSide: true,
        orderable : true,
        cache: false,
        ajax: '{{ route("dashboard.admins.client_datatables") }}',
        columns: [
            {data: 'id', name: 'id', searchable: true, orderable: true},
            {data: 'first_name', name: 'first_name', searchable: true, orderable: true},
            {data: 'last_name', name: 'last_name', searchable: true, orderable: true},
            {data: 'email', name: 'email', searchable: true, orderable: true},
            {data: 'created_at', name: 'created_at', searchable: true, orderable: true},
            {data: 'active', name: 'active', searchable: true, orderable: true},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: function (data, type, row) {
                    return `
                            <a href="{{ route('dashboard.admins.userProfile', '') }}/${row.id}"><i class="fa fa-eye"></i></a>
                            <form class="d-inline" method="POST" action="{{ route('dashboard.admin.destroy', '') }}/${row.id}">
                                @csrf
                    @method('post')
                   <input type="hidden" name="client_id" value="${row.id}">
                    <button type="submit" style="border:0 ; background-color:transparent; font-size:17px" class="text-danger" onclick="return confirm('Delete Author?')">
                        <i class="bx bx-trash"></i>
                    </button>
                </form>
`;
                }
            }
        ],
        "order": [0, 'desc'],
    });
</script>
