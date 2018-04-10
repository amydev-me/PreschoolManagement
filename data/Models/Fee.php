<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable=['feeName','description','amount'];
    public $timestamps=false;

    public function payments()
    {
        return $this->belongsToMany(Payment::class)->withPivot('payment_id','fee_id','amount');
    }
}
