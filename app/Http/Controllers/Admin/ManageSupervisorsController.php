<?php

namespace App\Http\Controllers\Admin;

use App\EmployeeDetails;
use App\Faculty;
use App\Helper\Reply;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateEmployee;
use App\Notifications\NewUser;
use App\Project;
use App\ProjectTimeLog;
use App\Role;
use App\Student;
use App\Supervisor;
use App\Task;
use App\User;
use App\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Facades\Datatables;

class ManageSupervisorsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('app.menu.employees');
        $this->pageIcon = 'icon-user';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Student::find(1)->proposal);
        return view('admin.supervisors.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.supervisors.create', $this->data, compact(['faculties']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->admission_staff_no = $request->input('admission_staff_no');
        $user->faculty_id = $request->input('faculty');
        $user->passrec = 0;
        $user->status = 1;
        $user->gender = $request->input('gender');
        $user->phone = $request->input('phone');
        $user->password = Hash::make('password');
        $user->save();
        if ($user->id) {
            //create student here
            $supervisor = new Supervisor();
            $supervisor->user_id = $user->id;
            $supervisor->save();
        }

        $user->attachRole(2);

        return Reply::redirect(route('admin.students.projects', $user->id), __('Supervisor Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->employee = User::find($id);
        return view('admin.supervisors.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->userDetail = User::find($id);
        $this->faculties = Faculty::all();
        return view('admin.supervisors.edit', $this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->admission_staff_no = $request->input('admission_staff_no');
        $user->faculty_id = $request->input('faculty');
        $user->password = Hash::make($request->input('admission_staff_no'));
        $user->save();
        return Reply::success(__('Supervisor Details Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {
            return Reply::error(__('messages.adminCannotDelete'));
        }

        User::destroy($id);
        return Reply::success(__('Supervisor Deleted Successfully'));
    }

    public function data()
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.admission_staff_no', 'faculties.faculty', 'users.email', 'users.created_at')
            ->where(['roles.name' => 'supervisor', ['users.id', '!=', 1]])
            ->get();
        //dd($users);
        return Datatables::of($users)
            ->addColumn('action', function ($row) {
                return '<a href="' . route('admin.supervisors.edit', [$row->id]) . '" class="btn btn-info btn-circle"
                      data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                      <a href="' . route('admin.students.projects', [$row->id]) . '" class="btn btn-success btn-circle"
                      data-toggle="tooltip" data-original-title="View Student Details"><i class="fa fa-search" aria-hidden="true"></i></a>

                      <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-user-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
            })
            ->editColumn(
                'name',
                function ($row) {
                    return '<a href="' . route('admin.students.projects', $row->id) . '">' . ucfirst($row->name) . '</a>';
                }
            )
            ->editColumn(
                'created_at',
                function ($row) {
                    return Carbon::parse($row->created_at)->format('d F, Y');
                }
            )
            ->rawColumns(['name', 'action'])
            ->make(true);
    }


    public function export()
    {
        $rows = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftjoin('courses', 'users.course_id', '=', 'courses.id')
            ->join('faculties', 'users.faculty_id', '=', 'faculties.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select(
                'users.id',
                'users.name',
                'users.admission_staff_no',
                'users.email',
                'users.phone',
                'faculties.faculty',
                'users.created_at'
            )
            ->where('roles.name', 'supervisor')
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $exportArray = [];

        // Define the Excel spreadsheet headers
        $exportArray[] = ['ID', 'Name', 'Admission', 'Email', 'Phone', 'Faculty', 'Created at'];;

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {
            $exportArray[] = $row->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('Supervisors', function ($excel) use ($exportArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Supervisors');
            $excel->setCreator('PFPMS')->setCompany('PFPMS');
            $excel->setDescription('Supervisors file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function ($sheet) use ($exportArray) {
                $sheet->fromArray($exportArray, null, 'A1', false, false);

                $sheet->row(1, function ($row) {

                    // call row manipulation methods
                    $row->setFont(array(
                        'bold' => true
                    ));

                });

            });


        })->download('xlsx');
    }

}
