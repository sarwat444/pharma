@extends('admins.layouts.app')

@push('title', 'الفواتير')

@push('styles')
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('dashboard.invoices.add_invoice')}}" id="addInvoiceBtn" class="btn btn-primary mb-3">إضافة فاتورة</a>
                    <table id="invoicesTable" class="table table-bordered dt-responsive nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>معرف الفاتورة</th>
                            <th>رقم الفاتورة</th>
                            <th>المبلغ الإجمالي</th>
                            <th>تاريخ الفاتورة</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة إضافة/تعديل فاتورة -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">إضافة / تعديل الفاتورة</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="invoiceForm">
                    <div class="modal-body">
                        <input type="hidden" id="invoice_id" name="invoice_id">

                        <!-- رقم الفاتورة -->
                        <div class="form-group">
                            <label for="invoice_number">رقم الفاتورة</label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
                        </div>

                        <!-- تاريخ الفاتورة -->
                        <div class="form-group">
                            <label for="invoice_date">تاريخ الفاتورة</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
                        </div>

                        <!-- اختيار الدواء -->
                        <div class="form-group">
                            <label for="medicine">اختر الدواء</label>
                            <select id="medicineSelect" class="form-control">
                                <option value="">اختر الدواء</option>
                                <!-- سيتم ملء الأدوية بواسطة AJAX -->
                            </select>
                            <button type="button" id="addMedicineBtn" class="btn btn-secondary mt-2">إضافة دواء</button>
                        </div>

                        <!-- قائمة الأدوية (الأدوية المضافة) -->
                        <div id="medicinesList">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>اسم الدواء</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الإجراء</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- سيتم إضافة الأدوية هنا ديناميكيًا -->
                                </tbody>
                            </table>
                        </div>

                        <!-- المبلغ الإجمالي -->
                        <div class="text-end mt-3">
                            <strong>المبلغ الإجمالي: <span id="totalAmount">0</span> العملة</strong>
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
@endsection

@push('scripts')
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // تهيئة DataTable للفواتير
            var table = $('#invoicesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard.invoices.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'invoice_number', name: 'invoice_number' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'invoice_date', name: 'invoice_date' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                language: {
                    url: '{{ asset("path-to-arabic-datatable-lang.json") }}' // ملف ترجمة DataTables للغة العربية
                }
            });

            // وظائف JavaScript الأخرى لإدارة النماذج والأدوية
        });
    </script>
@endpush
