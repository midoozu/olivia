<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'start_time',
            'field'      => 'id',
            'prefix'     => 'Clint name',
            'suffix'     => 'Doctor name',
            'route'      => 'frontend.appointments.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::with('client','doctor')->where('branch_id', Auth::user()->branch_id)->get() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }
                if ($model->follow_up == 0){
                $events[] = [
                    'title' => trim($model->client->first_name . ' '  . ' ' . '('.$model->doctor->name.')'),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                    'color'=>'red'

                ];
                }
                elseif ($model->check_in == 1 && $model->check_out == 0 ){
                    $events[] = [
                        'title' => trim($model->client->first_name . ' '  . ' ' . '('.$model->doctor->name.')'),
                        'start' => $crudFieldValue,
                        'url'   => route($source['route'], $model->id),
                        'color'=>'green'

                    ];
                }
                else
                    $events[] = [
                    'title' => trim($model->client->first_name . ' '  . ' ' . '('.$model->doctor->name.')'),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),

                ];

            }
        }

        return view('frontend.calendar.calendar', compact('events'));
    }
}
