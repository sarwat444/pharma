<?php

namespace App\Http\Controllers\Web\Admin\Admin;
use App\Models\MedicineNeed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineNeedController extends Controller
{

    public function index()
    {
        return view('admins.medicine_needs.index');
    }

    public function getMedicineNeeds()
    {
        $medicineNeeds = MedicineNeed::all(); // or your query logic
        return response()->json(['data' => $medicineNeeds]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quinity' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        MedicineNeed::create($validated);
        return response()->json(['success' => 'Record added successfully']);
    }

    public function update(Request $request, MedicineNeed $medicineNeed)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quinity' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $medicineNeed->update($validated);
        return response()->json(['success' => 'Record updated successfully']);
    }
        public function destroy(MedicineNeed $medicineNeed)
    {
        try {
            $medicineNeed->delete();

            return response()->json(['success' => 'تم حذف السجل بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء حذف السجل'], 500);
        }
    }
}
