<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/04/2018
 * Time: 8:47 AM
 */

namespace Data\Models;


use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
        protected $fillable=['payment_id','amount'];

        public function payment(){
            return $this->belongsTo(Payment::class);
        }
}