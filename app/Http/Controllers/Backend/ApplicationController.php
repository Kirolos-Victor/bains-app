<?php

namespace App\Http\Controllers\Backend;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Application;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        return view('backend.applications.index');
    }

    public function applications(Request $request): JsonResponse
    {
        $applications = Application::where('first_name', 'LIKE', "%{$request->first_name}%")
            ->where('last_name', 'LIKE', "%{$request->last_name}%")
            ->where('phone', 'LIKE', "%{$request->phone}%")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->where('job', 'LIKE', "%{$request->job}%")
            ->latest()
            ->paginate(10);
        return response()->json($applications);
    }

    public function toggleStatus(UpdateStatusRequest $request, Application $application)
    {
        $application->update([
            'status' => $request->status
        ]);
        session()->flash('success', 'You have successfully updated the application`s status.');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        session()->flash('success', 'You have successfully deleted the application.');
    }
}
