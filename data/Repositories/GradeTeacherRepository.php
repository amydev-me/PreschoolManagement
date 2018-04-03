<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 10:36 AM
 */

namespace Data\Repositories;


use Data\Models\GradeTeacher;

class GradeTeacherRepository extends Repository
{
    function model()
    {
       return GradeTeacher::class;
    }
    public function create(array $data = [])
    {

        $course= GradeTeacher::where('subject_id',$data['subject_id'])->where('grade_id',$data['grade_id'])->where('academic_id',$data['academic_id'])->where('teacher_id',$data['teacher_id'])->first();

        if($course){
            return false;
        }else{
            GradeTeacher::create($data);
            return true;
        }
    }

    public function update(array $data = [], $id, $attribute = 'id')
    {
        $course= GradeTeacher::where('subject_id',$data['subject_id'])->where('grade_id',$data['grade_id'])->where('academic_id',$data['academic_id'])->where('teacher_id',$data['teacher_id'])->first();

        if($course){
            return false;
        }else{
            $_data = GradeTeacher::where('id',$id);
            if ($_data) {
                return ($_data->update($data)) ? $_data : false;
            }
        }
    }

    public function getAll($page)
    {
        return GradeTeacher::with('academic','grade','teacher','subject')->paginate($page);
    }

    public function getByCategory($category_id,$page){
        return GradeTeacher::with('academic','grade','teacher','subject')->where('category_id',$category_id)->paginate($page);
    }
}