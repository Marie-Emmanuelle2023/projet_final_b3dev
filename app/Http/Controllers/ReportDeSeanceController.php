<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportDeSeance;
use App\Models\Seance;

class ReportDeSeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportDeSeances = ReportDeSeance::orderByDesc('date')->get();
        return view('report_de_seances.index', compact('reportDeSeances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seances = Seance::orderByDesc('date')->get();
        return view('report_de_seances.create', compact('seances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seance_reportee_id' => 'required|exists:seances,id',
            'seance_report_id' => 'required|exists:seances,id|different:seance_reportee_id',
            'date' => 'required|date',
        ]);
        ReportDeSeance::create($validated);
        return redirect()->route('report_de_seances.index')->with('success', 'Report ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportDeSeance $reportDeSeance)
    {
        return view('report_de_seances.show', compact('reportDeSeance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportDeSeance $reportDeSeance)
    {
        $seances = Seance::orderByDesc('date')->get();
        return view('report_de_seances.edit', compact('reportDeSeance', 'seances'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportDeSeance $reportDeSeance)
    {
        $validated = $request->validate([
            'seance_reportee_id' => 'required|exists:seances,id',
            'seance_report_id' => 'required|exists:seances,id|different:seance_reportee_id',
            'date' => 'required|date',
        ]);
        $reportDeSeance->update($validated);
        return redirect()->route('report_de_seances.index')->with('success', 'Report modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportDeSeance $reportDeSeance)
    {
        $reportDeSeance->delete();
        return redirect()->route('report_de_seances.index')->with('success', 'Report supprimé avec succès.');
    }
}
