<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path'
    ];

    public function rules()
    {
        return [
            'file' => 'required|mimes:txt'
        ];
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function sale($fileId)
    {
        $total = 0;
        $datas = File::find($fileId)->data;
        foreach ($datas as $data) {
            $total = ($data->quantity*$data->unit_price) + $total;
        }
        return number_format($total, 2, ',', '.') ;
    }
}
