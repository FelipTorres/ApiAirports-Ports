<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AirPort extends Model
{
    protected $fillable = ['id', 'country_id', 'name'];
    protected $table = 'airports';
    public $incrementing = false;

    public static function allDataBase()
    {
        return AirPort::all();
    }

    public static function specificAirPort($id)
    {
        try {
            return AirPort::find($id);

        } catch (\Throwable $e) {
            return back()->with(['error' => $e->getMessage()]);

        }
    }
}
