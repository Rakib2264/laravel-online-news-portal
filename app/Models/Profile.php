<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function districts()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function thana(){
        return $this->belongsTo(Thana::class);
    }



}
