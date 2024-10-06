<div class="modal fade" id="create-new-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافه المقرر </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.matarials.store')}}" id="store-new-category">
                    @csrf
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="code" class="col-form-label">  كود المقرر </label>
                            <input type="text" name="code" placeholder="كود المقرر" class="form-control" id="code" required>
                        </div>

                        <label for="goal" class="col-form-label"> نوع المقرر </label>
                        <select name="type" class="form-control">
                            <option value="0"> ألزامى</option>
                            <option value="1"> أنتقائي </option>
                            <option value="2"> أختياري </option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="goal" class="col-form-label">أسم المقرر  </label>
                        <input type="text" name="name" placeholder="أسم المقرر" class="form-control" id="name" required>
                        <input type="hidden" name="program_id" value="{{$program->id}}">
                    </div>
                    <div class="mb-2">
                        <label for="goal" class="col-form-label"> عدد  الوحدات  </label>
                        <input type="number" name="units" placeholder=" عدد الوحدات" class="form-control" id="name" required>
                    </div>

                    <div class="mb-2">
                        <label for="goal" class="col-form-label"> عدد  الساعات الأسبوعية  </label>
                        <div class="row">
                            <div class="col">
                                <label for="nazary">نظري</label>
                                <input type="number" name="nazary" placeholder="نظري" class="form-control" id="nazary" required>
                            </div>

                            <div class="col">
                                <label for="tamren">تمارين</label>
                                <input type="number" name="tamren" placeholder="تمارين" class="form-control" id="tamren" required>
                            </div>

                            <div class="col">
                                <label for="amaly">عملى</label>
                                <input type="number" name="amaly" placeholder="عملى" class="form-control" id="amaly" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="team" class="col-form-label"> الفرقة والمستوى </label>
                            <input type="text" name="team" placeholder="الفرقة والمستوى" class="form-control" id="team" required>
                        </div>
                        <div class="mb-2">
                            <label for="team" class="col-form-label">  الفصل الدراسى </label>
                            <input type="text" name="section" placeholder="الفصل الدراسي" class="form-control" id="section" required>
                        </div>

                    </div>

                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">تجاهل</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
