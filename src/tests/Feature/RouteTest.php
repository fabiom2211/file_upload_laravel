<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /** @test  */
    public function only_logged_in_users_can_see_home()
    {
        $response = $this->get('/')
            ->assertRedirect("/login");
    }
    /** @test  */
    public function only_logged_in_users_can_see_file_list()
    {
        $response = $this->get('/files')
            ->assertRedirect("/login");
    }
    /** @test  */
    public function only_logged_in_users_can_upload()
    {
        $response = $this->get('/upload-file')
            ->assertRedirect("/login");
    }

}
