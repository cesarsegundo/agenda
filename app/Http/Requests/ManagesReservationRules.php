<?php

namespace App\Http\Requests;

use App\Business\OpeningHourChecker;
use App\Business\StaffServiceChecker;
use App\Business\StaffAvailabilityChecker;
use App\Business\ClientAvailabilityChecker;

trait ManagesReservationRules
{
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
        if (! (new OpeningHourChecker($from, $to))
            ->check()) {
                abort(back()->withErrors("La reservación está fuera del horario de atención.")->withInput());
        }
    }
    public function checkRescheduleRules($scheduler, $staffUser, $clientUser, $from, $to, $service)
    {
        //clase para comprobar si el staff esta ocupado en ese horario
        if (! (new StaffAvailabilityChecker($staffUser, $from, $to))
            ->ignore($scheduler)
            ->check()) {
                abort(back()->withErrors('Este horario no está disponible')->withInput());
        }
        //clase para comprobar si el usuario ya tiene una reservacion en ese horario
        if (! (new ClientAvailabilityChecker($clientUser, $from, $to))
            ->ignore($scheduler)
            ->check()) {
                abort(back()->withErrors('Ya tinenes una reservación en este horario')->withInput());
        }
        //clase para comprobar si el staff seleccionado puede dar el servicio
        if (! (new StaffServiceChecker($staffUser, $service))
            ->check()) {
                abort(back()->withErrors("{$staffUser->name} no presta el servicio de {$service->name}")->withInput());
        }
        if (! (new OpeningHourChecker($from, $to))
            ->check()) {
                abort(back()->withErrors("La reservación está fuera del horario de atención.")->withInput());
        }
    }
}
