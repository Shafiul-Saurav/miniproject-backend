<?php

namespace App\Repositories\Unit;

use App\Models\Unit;

class UnitRepository implements UnitInterface
{
    /*
    * @return mixed|void
    */
    public function all()
    {
        $data = Unit::latest('id')->get();

        return $data;
    }

    /*
    * @return mixed|void
    */
    public function allPaginate($perPage)
    {
        $data = Unit::latest('id')
        ->when(request('search'), function($query) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('short_name', 'like', "%{$search}%");
            });
        })
        ->paginate($perPage);

        return $data;
    }

    /*
    * @return mixed|void
    */
    public function show($id)
    {
        $data = Unit::findOrFail($id);

        return $data;
    }

    /*
    * @param $data
    * @return mixed|void
    */
    public function store($requestData)
    {
        $data = Unit::create([
            'name' => $requestData->name,
            'short_name' => $requestData->short_name,
        ]);

        return $this->show($data->id);
    }

    /*
    * @param $data
    * @return mixed|void
    */
    public function update($requestData, $id)
    {
        $data = $this->show($id);

        $data->update([
            'name' => $requestData->name,
            'short_name' => $requestData->short_name,
        ]);

        return $data;
    }

    /*
    * @param $data
    * @return mixed|void
    */
    public function delete($id)
    {
        $data = $this->show($id);

        $data->delete();

        return $data;
    }

    /*
    * @param $data
    * @return mixed|void
    */
    // public function status($id)
    // {
    //     $data = $this->show($id);
    //     if ($data->is_active == 1) {
    //         $data->is_active = 0;
    //     } elseif($data->is_active == 0) {
    //         $data->is_active = 1;
    //     }

    //     $data->save();

    //     return $data;

    // }
}
