<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Requests\Web\Dashboard\Admin\UpdateRolesPermissionsRequest;
use App\Models\College;
use App\Models\Matarial;
use App\Models\MayearMokassy;
use App\Models\Program;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Traits\ResponseJson;
use App\Models\Admin;
use App\Models\User;
use App\Models\Question;
use App\Http\Requests\Web\Dashboard\Admin\StoreAdminRequest;
use App\Http\Requests\Web\Dashboard\Admin\UpdateAdminRequest;
use Illuminate\Http\Request ;
use App\Models\VideoClip;
use App\Models\Myear;
class AdminController extends Controller
{
    use ResponseJson;

    public Admin $adminModel;

    public function __construct(Admin $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $admins = Admin::with('college')->get() ;
        return view('admins.admins.index' ,compact('admins'));
    }
    public function create(): \Illuminate\Contracts\View\View
    {
        $collegs = College::get() ;
        $programs = Program::get();
        return view('admins.admins.new-user' , compact('collegs' , 'programs'));
    }
    public function store(StoreAdminRequest $storeAdminRequest): \Illuminate\Http\RedirectResponse
    {
        $validated        = $storeAdminRequest->validated();
        $validated['password']   = bcrypt($validated['password']);
        $this->adminModel->create(  $validated );
       return  redirect()->back()->with('success' , 'تم أضافه المدير  بنجاح');
    }

    public function edit($id )
    {
        $collegs = College::get() ;
        $programs = Program::get() ;
        $admin = Admin::find($id) ;
        return view('admins.admins.edit-user' , compact('collegs' , 'programs' ,'admin'));
    }

    public function update(UpdateAdminRequest $updateAdminRequest, Admin $admin): \Illuminate\Http\RedirectResponse
    {
        $validated        = $updateAdminRequest->validated();
        if (!empty($validated['password'])) {
            $validated['password']   = bcrypt($validated['password']);
        }
        $admin->update(  $validated );
        return  redirect()->back()->with('success' , 'تم تعديل  بيانات المدير بنجاح ');
    }

    public function editRolesAndPermissions(Admin $admin): \Illuminate\Http\JsonResponse
    {
        $permissions = Permission::all()->each(function ($permission) use ($admin) {
            $admin->hasPermissionTo($permission->name) ? $permission->setAttribute('checked', true) : $permission->setAttribute('checked', false);
        });
        $roles = Role::all()->each(function ($role) use ($admin) {
            $admin->hasRole($role->name) ? $role->setAttribute('checked', true) : $role->setAttribute('checked', false);
        });
        return $this->responseJson(['data' => ['roles' => $roles, 'permissions' => $permissions]], Response::HTTP_OK);
    }

    public function updateRolesAndPermissions(UpdateRolesPermissionsRequest $updateRolesPermissionsRequest, Admin $admin): \Illuminate\Http\JsonResponse
    {
        $admin->syncPermissions($updateRolesPermissionsRequest->validated()['permissions']);
        $admin->syncRoles($updateRolesPermissionsRequest->validated()['roles']);
        return $this->responseJson(['type' => 'success', 'message' => 'admin roles & permissions updated successfully'], Response::HTTP_OK);
    }

    public function Allclients(): \Illuminate\Contracts\View\View
    {
        return view('admins.clients.index');
    }

    public function getClientsDatatables(): \Illuminate\Http\JsonResponse
    {
        $users     = User::select('*');
        return datatables()->eloquent($users)
           // ->addIndexColumn()
            ->addColumn('active', function ($user) {
                return view('admins.clients.partials.active', compact('user'))->render();
            })
            ->rawColumns(['active'])
            ->toJson();
    }
    public function userProfile($user_id = null)
    {
      $user =  User::find($user_id) ;
      return view('admins.clients.profile.profile'  , compact('user')) ;
    }
    public  function profile_videos($user_id)
    {
        $user =  User::find($user_id) ;
        $videos =  VideoClip::select('*')->where('is_confirmed' , 0)->where('unknown', 0)->with(['user' , 'category'])->where('user_id' , $user_id)->get() ;
        return view('admins.clients.profile.videos' , compact('videos' , 'user' )) ;
    }
    public  function profile_questions($user_id)
    {
        $user =  User::find($user_id) ;
        $questions = Question::select('questions.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', '=', 'questions.category_id')
            ->withCount('views')
            ->withCount('likes')
            ->where('user_id' , $user_id)
        ->get();
        return view('admins.clients.profile.questions' , compact('questions' , 'user' )) ;
    }
    public function editProfile (Admin $admin)
    {
        return view('admins.admins.update_profile' , compact('admin'));
    }

    public function updateProfile(UpdateAdminRequest $updateAdminRequest , Admin $admin)
    {
        $validated        = $updateAdminRequest->validated();
        //dd( $validated );
        if (!empty($validated['password'])) {
            $validated['password']   = bcrypt($validated['password']);
        }

        if($updateAdminRequest->photo){
            $path = public_path('uploads/admins/');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file                 = $updateAdminRequest->file('photo');
            $fileName             = uniqid() . '_' . trim($file->getClientOriginalName());
            $validated['photo']   = $fileName;
            $file->move($path, $fileName);
        }

        $admin->update(  $validated );

        return redirect(route('admins.index'))->with('success', 'data updated successfully');
    }
    public function destroy($id  ,Request $request )
    {
        User::find($request->client_id)->delete();
        return redirect()->back()->with('success' ,  'Client Deleted  Successfuly') ;
    }
    public function create_mayear_barmagy_responsible()
    {
        $collegs = College::get() ;
        $programs = Program::get();
        return view ('admins.admins.create_mayear_barmagy_responsible' , compact('collegs' ,'programs')) ;
    }
    public function create_mayear_mokassy_responsible()
    {
        $collegs = College::get() ;
        return view ('admins.admins.create_mayear_mokassay_reponsibile' , compact('collegs')) ;
    }

    public function getMajors(Request $request)
    {
        $program_id = $request->program_id;
        $majors = Myear::withCount('mokashers')->where('program_id' , $program_id)->get();
        // Return the majors as JSON response
        return response()->json($majors);
    }
    public function getMatrials(Request $request)
    {
        $program_id = $request->program_id;
        $majors = Matarial::where('program_id' , $program_id)->get();
        // Return the majors as JSON response
        return response()->json($majors);
    }

    public function getMajorsMokassy(Request $request)
    {
        $college_id = $request->college_id;
        $myears = MayearMokassy::withCount('mokashers')->where('college_id' , $college_id)->get();
        return response()->json($myears);
    }

    /**********  Teachers ***************/
    public function teachers($college_id)
    {
        $admins = Admin::with('college')->where('role' , 2 )->get() ;
        return view('admins.teachers.index' ,compact('admins' , 'college_id'));
    }
    public function create_teacher($college_id)
    {
        $collegs = College::get() ;
        $programs = Program::get();
        return view('admins.teachers.create-teacher' , compact('collegs' , 'programs' ,'college_id'));
    }
}
