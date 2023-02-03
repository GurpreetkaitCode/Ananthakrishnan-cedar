<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'reservation_no',
        'guest_first_name',
        'guest_last_name',
        'country',
        'email',
        'room',
        'unit_no',
        'sub_total',
        'revenue',
        'check_in',
        'check_out',
        'create_date',
        'adults',
        'children',
        'notes',
        'total_days',
        'currency',
        'check_in_time',
        'check_out_time',
    ];

    public function getCheckInAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function getCheckOutAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function getCreateDateAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function setCheckInAttribute($value)
    {
        $this->attributes['check_in'] = date('Y-m-d', strtotime($value));
    }

    public function setCheckOutAttribute($value)
    {
        $this->attributes['check_out'] = date('Y-m-d', strtotime($value));
    }

    public function setCreateDateAttribute($value)
    {
        $this->attributes['create_date'] = date('Y-m-d', strtotime($value));
    }
}
