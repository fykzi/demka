<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function myReports()
    {
        $userId = Auth::id();
        
        $reports = Report::where('user_id', $userId)->get();
        
        return view('reports.my_reports', [
            'reports' => $reports,
        ]);
    }

    public function newReportForm()
    {
        return view("reports.new");
    }

    public function newReportCreate(Request $request)
    {
        $validated = $request->validate([
            'car_plate' => 'required|string|max:20',
            'description' => 'required|string',
        ]);
        
        try {
            $report = Report::create([
                'car_plate' => $validated['car_plate'],
                'description' => $validated['description'],
                'user_id' => Auth::id(),
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Ошибка создания заявки']);
        }

        return redirect()->route('reports.my')
            ->with('success', 'Заявка успешно создана!');
    }
}
