<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Business\StaffAvailabilityChecker;
use App\Business\ClientAvailabilityChecker;
use App\Business\StaffServiceChecker;

class MyScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from.date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'from.time' => 'required|date_format:H:i',
            'staff_user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ];
    }
    public function checkReservationRules($staffUser, $clientUser, $from, $to, $service)
    {
        //clase para comprobar si el staff esta ocupado en ese horario
        if (! (new StaffAvailabilityChecker($staffUser, $from, $to))
            ->check()) {
                abort(back()->withErrors('Este horario no está disponible')->withInput());
        }
        //clase para comprobar si el usuario ya tiene una reservacion en ese horario
        if (! (new ClientAvailabilityChecker($clientUser, $from, $to))
            ->check()) {
                abort(back()->withErrors('Ya tinenes una reservación en este horario')->withInput());
        }
        //clase para comprobar si el staff seleccionado puede dar el servicio
        if (! (new StaffServiceChecker($staffUser, $service))
            ->check()) {
                abort(back()->withErrors("{$staffUser->name} no presta el servicio de {$service->name}")->withInput());
        }
    }
}
