@extends('admins.layouts.app')

@push('title', __('admin-dashboard.medicines'))

@push('styles')
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 style="font-size: 20px ; font-weight: bold; margin-bottom: 30px" >احتياجات الأدوية</h2>
                    <button class="btn btn-success mb-3" id="addNew">إضافة دواء  جديد </button>
                    <table id="medicineNeedsTable" class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>اسم الدواء</th>
                            <th>الكمية</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <!-- Add/Edit Modal -->
                <div class="modal fade" id="medicineNeedModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="medicineNeedForm">
                                <div class="modal-header">
                                    <h5 class="modal-title">إضافة/تعديل احتياج</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="إغلاق"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="medicineNeedId">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">اسم الدواء</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quinity" class="form-label">الكمية</label>
                                        <input type="number" class="form-control" id="quinity" name="quinity" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق
                                    </button>
                                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @push('scripts')
            <script
                src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script
                src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <script
                src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script
                src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
            <script>
                $(document).ready(function () {
                    // Set up CSRF token for all AJAX requests
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // Initialize DataTable
                    let table = $('#medicineNeedsTable').DataTable({
                        ajax: '/admins/dashboard/medicine-needs/data',
                        columns: [
                            { data: 'id' },
                            { data: 'name' },
                            { data: 'quinity' },
                            {
                                data: 'id',
                                render: function (data) {
                                    return `
                            <button class="btn btn-warning btn-sm edit" data-id="${data}">تعديل</button>
                            <button class="btn btn-danger btn-sm delete" data-id="${data}">حذف</button>
                        `;
                                }
                            }
                        ],
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json'
                        }
                    });

                    // Open modal for adding new record
                    $('#addNew').click(function () {
                        $('#medicineNeedForm')[0].reset();
                        $('#medicineNeedId').val('');
                        $('#medicineNeedModal .modal-title').text('إضافة احتياج جديد');
                        $('#medicineNeedModal').modal('show');
                    });

                    // Edit record
                    $(document).on('click', '.edit', function () {
                        let id = $(this).data('id');
                        $.get(`/admins/dashboard/medicine-needs/data`, function (response) {
                            let medicineNeed = response.data.find(item => item.id == id);
                            if (medicineNeed) {
                                $('#medicineNeedId').val(medicineNeed.id);
                                $('#name').val(medicineNeed.name);
                                $('#quinity').val(medicineNeed.quinity);
                                $('#medicineNeedModal .modal-title').text('تعديل احتياج');
                                $('#medicineNeedModal').modal('show');
                            } else {
                                alert('فشل في جلب بيانات السجل');
                            }
                        }).fail(function () {
                            alert('حدث خطأ أثناء جلب البيانات');
                        });
                    });

                    // Handle form submission for Add/Edit
                    $('#medicineNeedForm').submit(function (e) {
                        e.preventDefault();
                        let id = $('#medicineNeedId').val();
                        let url = id
                            ? `/admins/dashboard/medicine-needs/update/${id}`
                            : '/admins/dashboard/medicine-needs/store';
                        let method = id ? 'PUT' : 'POST';

                        $.ajax({
                            url: url,
                            method: method,
                            data: $(this).serialize(),
                            success: function (response) {
                                $('#medicineNeedModal').modal('hide');
                                table.ajax.reload();
                                alert(response.success || 'تم الحفظ بنجاح');
                            },
                            error: function (xhr) {
                                alert('حدث خطأ أثناء العملية: ' + xhr.responseJSON?.message || 'يرجى المحاولة لاحقًا');
                            }
                        });
                    });

                    // Handle record deletion
                    $(document).on('click', '.delete', function () {
                        let id = $(this).data('id');
                        if (confirm('هل أنت متأكد أنك تريد حذف هذا السجل؟')) {
                            $.ajax({
                                url: `/admins/dashboard/medicine-needs/delete/${id}`,
                                method: 'DELETE',
                                success: function (response) {
                                    if (response.success) {
                                        table.ajax.reload();
                                        alert(response.success);
                                    } else {
                                        alert('لم يتم حذف السجل بنجاح');
                                    }
                                },
                                error: function (xhr) {
                                    alert('حدث خطأ أثناء حذف السجل');
                                }
                            });
                        }
                    });
                });
            </script>

    @endpush
