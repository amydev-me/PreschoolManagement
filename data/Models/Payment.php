<?php

namespace Data\Models;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice','total', 'student_id', 'grade_id', 'term_id', 'receipt_amount', 'amount', 'fine', 'status', 'payment_date', 'due_date','discount'];
//    protected $appends = ['total'];

        protected $dates=['payment_date','due_date'];
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function payment_details()
    {
        return $this->hasMany(PaymentDetail::class);
    }

    public function fees()
    {
        return $this->belongsToMany(Fee::class)->withPivot('payment_id', 'fee_id', 'amount');
    }
//
//    public function getTotalAttribute()
//    {
//        return $this->fees->sum('pivot.amount') + $this->amount;
//    }
}
