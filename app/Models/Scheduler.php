<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    use HasFactory;

    //Indica el nombre de la tabla
    protected $table = 'scheduler';

    protected $fillable = [
        'from',
        'to',
        'status',
        'staff_user_id',
        'client_user_id',
        'service_id',
    ];

    //Indicamos que estos campos dejen de ser un string para manejarlo con Carbon
    protected $dates = [
        'from',
        'to',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staffUser()
    {
        return $this->belongsTo(User::class);
    }

    public function clientUser()
    {
        return $this->belongsTo(User::class);
    }
}
