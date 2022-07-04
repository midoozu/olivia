
            <form action="{{route('admin.hrShifts.update',$find->id)}}" method="post" id="Form">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="row mt-2 mb-2 p-3 text-center">
                    <button type="button" class="btn d-flex btn-light-success w-100 d-block text-info font-weight-medium">
                        تعديل شيفتات الموظفين {{$find->title}}
                    </button>
                </div>
                <div class="col-lg-12 col-md-12  mb-4">
                    <label class="label mb-2 ">العنوان</label>
                    <input type="text" name="title"  value="{{$find->title}}" class="form-control" data-validation="required">
                </div>
            </div>
                <input name="updated_by" type="hidden" value="{{auth()->user()->id}}">
            </form>



