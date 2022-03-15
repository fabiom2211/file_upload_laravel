<?php

namespace Tests\Unit;

use App\Models\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /** @test */
    public function check_if_file_columns_is_correct()
    {
        $file = new File();

        $expected = [
            "name",
            "file_path"
        ];

        $arrayCompared = array_diff($expected, $file->getFillable());
        $this->assertEquals(0,count($arrayCompared));
    }
}
