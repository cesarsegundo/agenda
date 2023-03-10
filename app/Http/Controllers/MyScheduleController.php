<?php

namespace App\Http\Controllers;

use App\Models\Scheduler;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\MyScheduleRequest;

class MyScheduleController extends Controller
{
    public function index()
    {
        $date = Carbon::parse(request()->input('date'));

        $dayScheduler = Scheduler::where('client_user_id', auth()->id())
            ->whereDate('from', $date->format('Y-m-d'))
            ->orderBy('from', 'ASC')
            ->get();

        return view('my-schedule.index')
            ->with([
                'date' => $date,
                'dayScheduler' => $dayScheduler,
            ]);
    }
    public function create()
    {
        $services = Service::all();
        //Trae los usuarios que unicamente sean de rol "personal"
        $personalUsers = User::role('personal')->get();
        return view('my-schedule.create')
            ->with([
                'services' => $services,
                'personalUsers' => $personalUsers,
            ]);
    }
    public function store(MyScheduleRequest $request)
    {
        

        //Busca el service con el id del select del formulario
        $service = Service::find(request('service_id'));
        //le da el fomrato datatime que necesita la bd
        $from = Carbon::parse(request('from.date') . ' ' . request('from.time'));
        //le agrega la duracion del servicio 
        $to = Carbon::parse($from)->addMinutes($service->duration);
        $staffUser = User::find($request->input('staff_user_id'));

        $request->checkReservationRules($staffUser, auth()->user(), $from, $to, $service);

        Scheduler::create([
            'from' => $from,
            'to' => $to,
            'status' => 'pendiente',
            'staff_user_id' => request('staff_user_id'),
            //id del cliente que tiene iniciada la sesion
            'client_user_id' => auth()->id(),
            'service_id' => $service->id,
        ]);

        return redirect(route('my-schedule', ['date' => $from->format('Y-m-d')]));
    }
    public function edit(Scheduler $scheduler)
    {
        // if (auth()->user()->cannot('update', $scheduler)) {
        //     abort(403, 'Acci??n no autorizada.');
        // }
        $services = Service::all();
        //Trae los usuarios que unicamente sean de rol "personal"
        $personalUsers = User::role('personal')->get();
        return view ('my-schedule.edit')
            ->with([
                'scheduler' => $scheduler,
                'services' => $services,
                'personalUsers' => $personalUsers,
            ]);
    }
    public function update(Scheduler $scheduler, MyScheduleRequest $request)
    {
        // if (auth()->user()->cannot('update', $scheduler)) {
        //     abort(403, 'Acci??n no autorizada.');
        // }
        //Busca el service con el id del select del formulario
        $service = Service::find(request('service_id'));
        //le da el fomrato datatime que necesita la bd
        $from = Carbon::parse(request('from.date') . ' ' . request('from.time'));
        //le agrega la duracion del servicio 
        $to = Carbon::parse($from)->addMinutes($service->duration);
        $staffUser = User::find($request->input('staff_user_id'));

        $request->checkRescheduleRules($scheduler, $staffUser, auth()->user(), $from, $to, $service);

        $scheduler->update([
            'from' => $from,
            'to' => $to,
            'staff_user_id' => request('staff_user_id'),
            'service_id' => $service->id,
        ]);

        return redirect(route('my-schedule', ['date' => $from->format('Y-m-d')]));
    }
    public function destroy(Scheduler $scheduler)
    {
        // if (auth()->user()->cannot('delete', $scheduler)) {
        //     return back()->withErrors('No es posible cancelar esta cita');
        // }
        $scheduler->delete();
        //nos retorna a la vista en la que estamos
        return back();
    }
}
