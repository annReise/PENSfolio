<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $portfolios = $user->portfolios()
            ->latest()
            ->get();

        return view('portfolio.index', compact('portfolios'));
    }

    public function create(): View
    {
        return view('portfolio.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link'        => ['nullable', 'url'],
            'image'       => ['nullable', 'image', 'max:2048'], // <= tambah ini
        ]);

        // handle upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio = $request->user()->portfolios()->create($validated);

        return redirect()
            ->route('portfolio.index')
            ->with('success', 'Portofolio berhasil dibuat.');
    }

    public function show(Portfolio $portfolio): View
    {
        $this->authorize('view', $portfolio);

        return view('portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio): View
    {
        $this->authorize('update', $portfolio);

        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $this->authorize('update', $portfolio);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link'        => ['nullable', 'url'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($validated);

        return redirect()
            ->route('portfolio.index')
            ->with('success', 'Portofolio berhasil diupdate.');
    }


    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $this->authorize('delete', $portfolio);

        $portfolio->delete();

        return redirect()
            ->route('portfolio.index')
            ->with('success', 'Portofolio berhasil dihapus.');
    }
}
