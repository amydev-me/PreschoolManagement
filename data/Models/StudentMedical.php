<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMedical extends Model
{
    protected $fillable=['student_id','asthma','asthma_remark','allergies','allergies_remark','diabetes','diabetes_remark',
        'epilepsy','epilepsy_remark','tuberculosis','tuberculosis_remark','others_check','others','medication',
        'immunized','immunized_remark','immunized_file','emotional','disabilities','behavioral'];
    public $timestamps=false;
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
