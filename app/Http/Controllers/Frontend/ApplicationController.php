<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\JobEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $jobs = JobEnum::cases();
        return view('frontend.application', compact('jobs'));
    }

    public function store(StoreApplicationRequest $request)
    {
        $data = $request->validated();
        if (!array_key_exists('previous_experience', $data)) {
            $data['previous_experience'] = 0;
        }
        Application::create($data);
        return redirect()->back()->with('success', 'You have successfully applied for the job.');
    }
}
