<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $author = Auth::user()->id;

        $reports = Report::whereHas('post', function ($query) use ($author) {
            $query->where('user_id', $author);
        })->with('post', 'user')->get();

        return view('dashboard.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportRequest $request)
    {
        $validateData = $request->validated();

        try {
            $validateData['user_id'] = Auth::user()->id;

            Report::create($validateData);

            return redirect()->route('blog')->with('success', 'Create Report Success!');
        } catch (\Throwable $e) {

            return redirect()->route('blog')->with('success', 'Failed Create Report. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportRequest $request, Report $report)
    {
        $validateData = $request->validated();

        try {
            $report->update($validateData);

            return redirect()->route('reports.index')->with('success', 'Update Report Success!');
        } catch (\Throwable $e) {

            return redirect()->route('reports.index')->with('success', 'Failed Update Report. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        try {
            $report->delete();

            return redirect()->route('reports.index')->with('success', 'Delete Report Success!');
        } catch (\Throwable $e) {

            return redirect()->route('reports.index')->with('success', 'Failed Delete Report. ' . $e->getMessage());
        }
    }
}
