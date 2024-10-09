@extends('admins.layouts.app')

@push('title', 'الفواتير')

@push('styles')
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        html , body , input
        {
            text-align: right;
            direction: rtl;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="invoiceForm">
                        <div class="modal-body">
                            <div class="card-title mb-4" >بيانات الفاتورة</div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" id="invoice_id" name="invoice_id">
                                    <!-- رقم الفاتورة -->
                                    <div class="form-group mb-3">
                                        <label for="invoice_number">رقم الفاتورة</label>
                                        <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
                                    </div>

                                    <!-- تاريخ الفاتورة -->
                                    <div class="form-group  mb-3">
                                        <label for="invoice_date">تاريخ الفاتورة</label>
                                        <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
                                    </div>
                                    <!-- حقل البحث -->
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group  mb-3">
                                        <label for="medicineSearch">ابحث عن الدواء</label>
                                        <input type="text" id="medicineSearch" class="form-control" placeholder="ادخل اسم الدواء أو الكود">
                                    </div>
                                    <!-- جدول نتائج البحث -->
                                    <div class="form-group">
                                        <table id="searchResults" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>اسم الدواء</th>
                                                <th>السعر</th>
                                                <th>الكمية المتاحة</th> <!-- Updated to show available quantity -->
                                                <th>الإجراء</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Results will be dynamically added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">








                            <!-- جدول الأدوية المضافة -->
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
                                    <!-- الأدوية ستتم إضافتها هنا ديناميكيًا -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- الإجمالي -->
                            <div class="text-end mt-3">
                                <strong>المبلغ الإجمالي: <span id="totalAmount">0</span> العملة</strong>
                            </div>

                            <!-- Save button to store the invoice -->
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success">حفظ الفاتورة</button>
                            </div>

                        </div>
                    </form>
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
            // Search for medicines by name or code
            $('#medicineSearch').on('input', function() {
                var query = $(this).val();

                if (query.length > 1) {
                    $.ajax({
                        url: '{{ route('dashboard.medicines.search') }}',
                        data: { query: query },
                        success: function(data) {
                            // Clear the search results table before appending new results
                            $('#searchResults tbody').empty();

                            if (data.length > 0) {
                                // Populate the search results table with the found medicines
                                $.each(data, function(index, medicine) {
                                    $('#searchResults tbody').append(`
                                        <tr>
                                            <td>${medicine.name} (${medicine.code})</td>
                                            <td class="medicine-price">${medicine.price}</td>
                                            <td class="available-quantity">${medicine.quinity}</td> <!-- Display available quinity -->
                                            <td>
                                                <button type="button" class="btn btn-primary add-medicine" data-id="${medicine.id}" data-name="${medicine.name}" data-price="${medicine.price}" data-quinity="${medicine.quinity}">إضافة</button>
                                            </td>
                                        </tr>
                                    `);
                                });
                            } else {
                                $('#searchResults tbody').append('<tr><td colspan="4">لا توجد نتائج</td></tr>');
                            }
                        }
                    });
                } else {
                    $('#searchResults tbody').empty(); // Clear results if search query is too short
                }
            });

            // Add selected medicine to the invoice table
            $(document).on('click', '.add-medicine', function() {
                var medicineId = $(this).data('id');
                var medicineName = $(this).data('name');
                var price = $(this).data('price');
                var availablequinity = $(this).data('quinity');
                var quinity = 1; // Default quinity

                // Check if the available quinity is greater than 0
                if (availablequinity <= 0) {
                    alert('لا يمكن إضافة هذا الدواء لأنه غير متاح في المخزون.');
                    return;
                }

                // Append medicine to the medicines table
                $('#medicinesList tbody').append(`
                    <tr>
                        <td>${medicineName}</td>
                        <td class="medicine-price">${price}</td>
                        <td>
                            <input type="number" class="form-control quinity" value="${quinity}" min="1" max="${availablequinity}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-medicine">حذف</button>
                        </td>
                    </tr>
                `);

                updateTotalAmount();
            });

            // Update total amount when quinity changes
            $(document).on('input', '.quinity', function() {
                var availablequinity = parseInt($(this).attr('max'));
                var quinity = parseInt($(this).val());

                // Ensure the entered quinity does not exceed available quinity
                if (quinity > availablequinity) {
                    alert('الكمية المدخلة أكبر من المتاحة.');
                    $(this).val(availablequinity); // Reset to max available
                }

                updateTotalAmount();
            });

            // Remove medicine from the list
            $(document).on('click', '.remove-medicine', function() {
                $(this).closest('tr').remove();
                updateTotalAmount();
            });

            // Function to calculate the total amount
            function updateTotalAmount() {
                var total = 0;
                $('#medicinesList tbody tr').each(function() {
                    var price = parseFloat($(this).find('.medicine-price').text());
                    var quinity = parseInt($(this).find('.quinity').val());
                    total += price * quinity;
                });
                $('#totalAmount').text(total);
            }

            // Submit the invoice and update medicine quantities
            $('#invoiceForm').on('submit', function(e) {
                e.preventDefault();

                var invoiceData = {
                    invoice_number: $('#invoice_number').val(),
                    invoice_date: $('#invoice_date').val(),
                    medicines: []
                };

                $('#medicinesList tbody tr').each(function() {
                    var medicineId = $(this).find('.add-medicine').data('id'); // Get medicine ID
                    var quinity = parseInt($(this).find('.quinity').val());
                    invoiceData.medicines.push({
                        id: medicineId,
                        quinity: quinity
                    });
                });

                $.ajax({
                    url: '{{ route("dashboard.invoices.store") }}',
                    method: 'POST',
                    data: invoiceData,
                    success: function(response) {
                        alert('تم حفظ الفاتورة بنجاح!');

                        // Update medicine quantities in the database
                        $.each(invoiceData.medicines, function(index, medicine) {
                            $.ajax({
                                url: '{{ route("dashboard.medicines.updatequinity") }}', // Ensure this route is set up
                                method: 'POST',
                                data: {
                                    id: medicine.id,
                                    quinity: medicine.quinity
                                },
                                success: function(updateResponse) {
                                    // Handle any success response if needed
                                }
                            });
                        });

                        window.location.reload(); // Reload to reset the form
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء حفظ الفاتورة.');
                    }
                });
            });
        });
    </script>

@endpush
