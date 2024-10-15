<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cosmatics;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CosmaticsController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Cosmatics $CollegeModel){}

    public function index()
    {
        return view('admins.cosmatics.index'); // Return the view without fetching data here
    }
    public function show()
    {
        $medicines = Cosmatics::select(['id', 'name' , 'price','quinity']);

        return DataTables::of($medicines)
            ->addColumn('action', function ($medicine) {
                return '<button class="btn btn-sm btn-primary editMedicineBtn" data-id="' . $medicine->id . '">تعديل</button>
                <form method="POST" action="' . route('dashboard.cosmatics.destroy', $medicine->id) . '" style="display:inline;">
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
            ->rawColumns(['action', 'name']) // Allow HTML in these columns
            ->make(true);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quinity' => 'required|integer'
        ]);

        Cosmatics::create($request->all());

        return response()->json(['success' => 'تم أضافة المستلزمات بنجاح']);
    }

    public function edit($id)
    {
        $cosmatics = Cosmatics::findOrFail($id);
        return response()->json($cosmatics);
    }

    public function update(Request $request, $id)
    {
        $medicine = Cosmatics::findOrFail($id);
        $medicine->name = $request->input('name');
        $medicine->price = $request->input('price');
        $medicine->quinity = $request->input('quinity');
        $medicine->save();
        return response()->json(['success' => true]);
    }

    public function list()
    {
        $cosamtics = Cosmatics::select('id', 'name', 'price')->get();
        return response()->json($cosamtics);
    }

    public function destroy($id)
    {
        $cosmatics  =  Cosmatics::find($id) ;
        $cosmatics->delete() ;
        return redirect()->back()->with('success' , 'تم الحذف') ;
    }
}
