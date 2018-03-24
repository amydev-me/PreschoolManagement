<?php

namespace Data\Repositories;

use Data\Models\Academic;

class AcademicYearRepository extends Repository
{
    function model()
    {
       return Academic::class;
    }

    public function create(array $data = [])
    {
        if ($data['active_year']) {
            $batch = Academic::where('active_year', '=', 1);
            $mod = array('active_year' => 0);
            if ($batch) {
                $batch->update($mod);
            }
        }
        return Academic::create($data);
    }

    public function update(array $data = [], $id, $attribute = 'id')
    {
        if ($data['active_year']) {
            $batch = Academic::where('active_year', '=', 1)->where('id', '<>', $id);
            if ($batch) {
                $batch->update(array('active_year' => 0));
            }
        }

        $_data = Academic::where($attribute, $id);
        if ($_data) {
            return ($_data->update($data)) ? $_data : false;
        }
    }

    public function getData($pages)
    {
        return Academic::orderByDesc('id')->paginate($pages);
    }

    public function getByNameWithPaginate($value, $attribute, $pages)
    {
        return Academic::where($attribute, 'LIKE', $value . '%')->orderByDesc('id')->paginate($pages);
    }

    public function asyncGetData()
    {
        return Academic::orderBy('academicName')->get();
    }


}