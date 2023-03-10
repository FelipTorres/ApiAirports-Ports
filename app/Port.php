<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable     = ['id', 'country_id', 'name', 'rail_ramp', 'external'];
    protected $table = 'ports';
    public $incrementing = false;

    public static function allDataBase()
    {
        return Port::all();
    }

    public static function specificPort($id)
    {
        try {
            return Port::find($id);

        } catch (\Throwable $e) {
            return back()->with(['error' => $e->getMessage()]);

        }
    }
}
