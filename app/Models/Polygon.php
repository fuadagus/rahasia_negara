<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_lahan';

    protected $guarded = ['id'];

    public function polygons()
    {
        return $this->select(DB::raw('id, remark, description, image, ST_AsGeoJSON(geom) as geom '))->get();
    }
    public function polygon($id)
    {
        return $this->select(DB::raw('id, remark, description, image, ST_AsGeoJSON(geom) as geom'))
        -> where('id', $id)->get();
    }
}
