<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_application_index_page()
    {
        $response = $this->get('/application');
        $response->assertStatus(200);
    }

    public function test_submit_application()
    {
        $formData = [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@test.com',
            'phone' => '1111111111',
            'date_of_birth' => '21-6-1997',
            'job' => 'programmer',
        ];
        $this->post('/application', $formData);
        $this->assertDatabaseCount('applications', 1);
    }
}
