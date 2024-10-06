<div class="modal fade" id="create-new-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافه نواتج تعلم جديده </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.output_eduction.store_map')}}" id="store-new-category">
                    @csrf
                    <div class="mb-2">
                        <label for="goal" class="col-form-label">أسم الناتج </label>
                        <select name="teaching_outputs_id" class="form-control">
                            @foreach($eduction_outputs as $output)
                               <option value="{{$output->id}}"> {{$output->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="matarial_id" value="{{$matarial->id}}">
                        <input type="hidden" name="added_by" value="{{Auth()->id()}}">
                        <input type="hidden" name="week_number" value="{{$week_number}}">
                        <input type="hidden" name="type" value="{{$eduction_type}}">
                        <input type="hidden" name="main_type" value="map">
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
