

    <div class="card">
                <div class="card-body  p-0" >
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category99">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه أسلوب التقويم
                        </button>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th> أسلوب  التقويم</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($taqweem as $output)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> <p>{{ $output->name }} </p> </td>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <!--
                                        <a href="javascript:void(0);" data-category-id="{{ $output->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                           -->
                                        <form action="{{ route('dashboard.week_taqweem.destroy', $output->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
