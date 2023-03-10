<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPageApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected mixed $admin;
    protected mixed $application;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        User::factory()->create([
            'is_admin' => 1
        ]);
        Application::factory()->create();
        $this->admin = User::first();
        $this->application = Application::first();
    }

    public function test_admin_applications_page()
    {
        $this->actingAs($this->admin);
        $response = $this->get('/admin/applications');
        $response->assertStatus(200);
    }

    public function test_admin_approve_applications()
    {
        $this->actingAs($this->admin);
        $dataForm = [
            'status' => 'approved'
        ];
        $this->post('/admin/applications/' . $this->application->id, $dataForm);
        $this->assertDatabaseHas('applications', [
            'status' => 'approved'
        ]);
    }

    public function test_admin_deny_applications()
    {
        $this->actingAs($this->admin);
        $dataForm = [
            'status' => 'denied'
        ];
        $this->post('/admin/applications/' . $this->application->id, $dataForm);
        $this->assertDatabaseHas('applications', [
            'status' => 'denied'
        ]);
    }

    public function test_admin_soft_delete_applications()
    {
        $this->actingAs($this->admin);
        $this->delete('/admin/applications/' . $this->application->id);
        $this->assertDatabaseHas('applications', [
            'deleted_at' => Carbon::now()
        ]);
    }
}
