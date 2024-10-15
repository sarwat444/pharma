<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cosmatics;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Admin\Colleges\{StoreCollegeRequest, UpdateCollegeRequest};
use App\Models\Medicine;
use App\Models\College;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use  Illuminate\Http\Request ;


class MedcineController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly College $CollegeModel){}

    public function index()
    {
        return view('admins.medicines.index'); // Return the view without fetching data here
    }

    public function getMedicinesData()
    {
        $medicines = Medicine::select(['id', 'name','strip_number' , 'price', 'strip_price', 'expire', 'quinity', 'code']);

        return DataTables::of($medicines)
            ->addColumn('action', function ($medicine) {
                return '<button class="btn btn-sm btn-primary editMedicineBtn" data-id="' . $medicine->id . '">تعديل</button>
                <form method="POST" action="' . route('dashboard.medcine.destroy', $medicine->id) . '" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                </form>';
            })
            ->editColumn('name', function ($medicine) {
                return '<strong>' . $medicine->name . '</strong>';
            })
            ->editColumn('price', function ($medicine) {
                return number_format($medicine->price, 2) . ' ج.م';
            })
            ->editColumn('strip_price', function ($medicine) {
                return number_format($medicine->strip_price, 2) . ' ج.م';
            })
            ->editColumn('expire', function ($medicine) {
                try {
                    return \Carbon\Carbon::createFromFormat('d/m/Y', $medicine->expire)->format('d-m-Y');
                } catch (\Exception $e) {
                    return $medicine->expire;
                }
            })
            ->editColumn('code', function ($medicine) {
                return $medicine->code; // Display the code in the table
            })
            ->rawColumns(['action', 'name']) // Allow HTML in these columns
            ->make(true);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'strip_price' => 'required|numeric',
            'expire' => 'required', // Ensure proper date format
            'quinity' => 'required|integer',
            'strip_number' => 'required|integer'
        ]);

        Medicine::create($request->all());

        return response()->json(['success' => 'Medicine added successfully']);
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return response()->json($medicine);
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->name = $request->input('name');
        $medicine->price = $request->input('price');
        $medicine->strip_price = $request->input('strip_price');
        $medicine->expire = $request->input('expire');
        $medicine->quinity = $request->input('quinity');
        $medicine->code = $request->input('code'); // Update the code
        $medicine->strip_number = $request->input('strip_number'); // Update the code
        $medicine->save();

        return response()->json(['success' => true]);
    }

    public function list()
    {
        // Fetch the list of medicines, adjust this as needed
        $medicines = Medicine::select('id', 'name', 'price')->get();

        // Return the medicines as JSON or in the format you need
        return response()->json($medicines);
    }
    public function destroy ($id)
    {
        $medcine =  Medicine::find($id) ;
        $medcine->delete() ;
        return redirect()->back()->with('success' , 'تم الحذف') ;
    }
    public function statistics()
    {
        // Count total number of medicines
        $medicine_count = Medicine::count();

        // Calculate total price
        $total = Medicine::all()->sum(function ($medicine) {
            return $medicine->strip_number * $medicine->strip_price;
        });

        $cosmatics_total = Cosmatics::all()->sum(function ($medicine) {
            return $medicine->price * $medicine->quinity;
        });



        // Return view with data
        return view('admins.statistics.index', compact('medicine_count', 'total' ,'cosmatics_total'));
    }
}
