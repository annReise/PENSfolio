<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Daftar lowongan untuk mahasiswa.
     */
    public function index()
    {
        // Bisa tambahkan filter nanti (lokasi, tipe, dsb)
        $jobs = Job::latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Detail lowongan.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }
}
