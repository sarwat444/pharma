@extends('admins.layouts.app')

@push('title', __('admin-dashboard.medicines'))

@push('styles')
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- Add/Edit Medicine Modal -->
    <div class="modal fade" id="medicineModal" tabindex="-1" role="dialog" aria-labelledby="medicineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="medicineModalLabel">إضافة / تعديل الدواء</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="medicineForm">
                    <div class="modal-body">
                        <input type="hidden" id="medicine_id">
                        <!-- Form Fields -->
                        <div class="form-group">
                            <label for="name">اسم الدواء</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">سعر العلبة</label>
                            <input type="number" class="form-control" id="price" name="price" required step="0.01" min="0">
                        </div>

                        <div class="form-group">
                            <label for="price">  عدد الشرايط</label>
                            <input type="number" class="form-control" id="strip_number" name="strip_number" required step="0.01" min="0">
                        </div>

                        <div class="form-group">
                            <label for="strip_price">سعر الشريط</label>
                            <input type="number" class="form-control" id="strip_price" name="strip_price" required step="0.01" min="0">
                        </div>
                        <div class="form-group">
                            <label for="expire">تاريخ الانتهاء</label>
                            <input type="date" class="form-control" id="expire" name="expire" placeholder="dd/mm/yyyy" required>
                        </div>
                        <div class="form-group">
                            <label for="quinity">الكمية</label>
                            <input type="number" class="form-control" id="quinity" name="quinity" required>
                        </div>
                        <div class="form-group">
                            <label for="scanner_input">مدخل الماسح الضوئي (RQ Scanner)</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Scan barcode here">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Add Medicine Button -->
                    <button id="addMedicineBtn" class="btn btn-primary mb-3">إضافة دواء جديد</button>

                    <!-- Total Row -->
                    <div class="text-end">
                        <strong>إجمالي السعر: <span id="totalAmount">0</span> ج.م</strong>
                    </div>

                    <table id="medicinesTable" class="table table-bordered dt-responsive nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>المعرف</th>
                            <th>الاسم</th>
                            <th>السعر</th>
                            <th>سعر الشريط</th>
                            <th>عدد الشرايط</th>
                            <th>تاريخ الانتهاء</th>
                            <th>الكمية</th>
                            <th>الرمز</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Rows will be populated by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize DataTable
            var table = $('#medicinesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard.medicines.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'strip_price', name: 'strip_price' },
                    { data: 'strip_number', name: 'strip_number' },
                    { data: 'expire', name: 'expire' },
                    { data: 'quinity', name: 'quinity' },
                    { data: 'code', name: 'code' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                responsive: true,
                autoWidth: false,
                drawCallback: function() {
                    calculateTotalAmount(); // Calculate total when data is loaded
                }
            });

            // Function to calculate total amount
            function calculateTotalAmount() {
                var total = 0;
                table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                    var data = this.data();
                    var strip_number = parseFloat(data.strip_number) || 0;
                    var strip_price = parseFloat(data.strip_price.replace(/[^0-9.-]+/g, "")) || 0;
                    total += strip_number * strip_price;
                });
                $('#totalAmount').text(total.toFixed(2));
            }

            // Show the modal for adding a new medicine
            $('#addMedicineBtn').on('click', function() {
                $('#medicineForm')[0].reset();
                $('#medicine_id').val(''); // Clear hidden field
                $('#medicineModal').modal('show');
            });

            // Form submission handler
            $('#medicineForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var medicineId = $('#medicine_id').val();
                var actionUrl = medicineId
                    ? '{{ route("dashboard.medcine.update", ":id") }}'.replace(':id', medicineId)
                    : '{{ route("dashboard.medcine.store") }}';

                $.ajax({
                    url: actionUrl,
                    method: medicineId ? 'PUT' : 'POST',
                    data: formData,
                    success: function(response) {
                        $('#medicineModal').modal('hide');
                        table.ajax.reload();
                        alert('تم حفظ البيانات بنجاح');
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON?.message ?? 'حدث خطأ أثناء حفظ البيانات';
                        alert(errorMessage);
                    }
                });
            });

            // Edit button click handler
            $(document).on('click', '.editMedicineBtn', function() {
                var medicineId = $(this).data('id');
                $.ajax({
                    url: '{{ route("dashboard.medcine.edit", ":id") }}'.replace(':id', medicineId),
                    method: 'GET',
                    success: function(data) {
                        $('#medicine_id').val(data.id);
                        $('#name').val(data.name);
                        $('#price').val(data.price);
                        $('#strip_price').val(data.strip_price);
                        $('#expire').val(data.expire);
                        $('#quinity').val(data.quinity);
                        $('#code').val(data.code);
                        $('#strip_number').val(data.strip_number);
                        $('#medicineModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء جلب البيانات');
                    }
                });
            });
        });
    </script>
@endpush
