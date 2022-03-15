<?php

namespace Tests\Unit;

use App\Models\Data;
use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
    /** @test */
    public function check_if_data_columns_is_correct()
    {
        $data = new Data();

        $expected = [
            'buyer',
            'description',
            'unit_price',
            'quantity',
            'address',
            'provider'
        ];

        $arrayCompared = array_diff($expected, $data->getFillable());
        //dd($arrayCompared);
        $this->assertEquals(0,count($arrayCompared));
    }
}
