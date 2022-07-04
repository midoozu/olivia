<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Doctor_Percentage;
use App\Models\DrAppointmentPercent;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DrAppointmentPercentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::with(['services', 'media'])->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('name', 'id');

        return view('admin.doctors.create', compact('services'));
    }

    public function store(StoreDoctorRequest $request)
    {


        $doctor = Doctor::create($request->all());

        if ($request->service_id != 0) {
            foreach ($request->service_id as $key => $s) {

                Doctor_Percentage::create([
                    'doctor_id'=>$doctor->id,
                    'service_id'=>$request->service_id[$key],
                    'Percentage'=> $request->doctor_price[$key]
                ]);
            }
        }

//        $doctor->services()->sync($request->input('services', []));
        foreach ($request->input('photo', []) as $file) {
            $doctor->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $doctor->id]);
        }

        return redirect()->route('admin.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('name', 'id');

        $doctor->load('services');

        return view('admin.doctors.edit', compact('services', 'doctor'));
    }

    public function update(DrAppointmentPercent $DrAppointmentPercent)
    {

        dd('test');

        return redirect()->route('admin.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('services', 'doctorAppointments','drpercentage');
$doctorpercent = DrAppointmentPercent::where('dr_id',$doctor->id)->whereDate('created_at',today())->sum('percent');

        return view('admin.doctors.show', compact('doctor','doctorpercent'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        Doctor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('doctor_create') && Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Doctor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
