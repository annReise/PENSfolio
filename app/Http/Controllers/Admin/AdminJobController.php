<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'company_name'    => 'required|string|max:255',
            'company_logo'    => 'nullable|image|max:2048',
            'description'     => 'nullable|string',
            'requirements'    => 'nullable|string',
            'location'        => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'apply_link'      => 'nullable|url|max:255',
            'deadline'        => 'nullable|date',
        ]);

        // upload logo jika ada
        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        Job::create($data);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'company_name'    => 'required|string|max:255',
            'company_logo'    => 'nullable|image|max:2048',
            'description'     => 'nullable|string',
            'requirements'    => 'nullable|string',
            'location'        => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'apply_link'      => 'nullable|url|max:255',
            'deadline'        => 'nullable|date',
        ]);

        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $job->update($data);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}
