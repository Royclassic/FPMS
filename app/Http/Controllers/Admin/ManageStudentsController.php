<?php

namespace App\Http\Controllers\Admin;

use App\ClientDetails;
use App\Faculty;
use App\Course;
use App\Helper\Reply;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Invoice;
use App\Notifications\NewUser;
use App\Project;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class ManageStudentsController extends AdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->pageTitle = __('app.menu.clients');
        $this->pageIcon = 'icon-people';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.students.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $faculties=Faculty::all();
        return view('admin.students.create', $this->data, compact(['faculties']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->admission_staff_no = $request->input('admission_staff_no');
        $user->faculty_id=$request->input('faculty');
        $user->course_id=$request->input('course');
        $user->passrec=0;
        $user->status=1;
        $user->gender=$request->input('gender');
        $user->phone=$request->input('phone');
        $user->year=$request->input('year');
        $user->password = Hash::make('password');
        $user->save();
        if($user->id){
            //create student here
            $student = new Student();
            $student->user_id = $user->id;
            $student->save();        }

        $user->attachRole(3);
        //$user->notify(new NewUser($user));
        return Reply::redirect(route('admin.students.supervisor', $user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->client = User::find($id);
        return view('admin.students.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->userDetail = User::find($id);
        $this->faculties=Faculty::all();
        return view('admin.students.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->admission_staff_no = $request->input('admission_staff_no');
        $user->faculty_id=$request->input('faculty');
        $user->course_id=$request->input('course');
        $user->password = Hash::make($request->input('admission_staff_no'));
        $user->save();

        return Reply::success(__('Student Info Updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Reply::success(__('Student Deleted Successfully'));
    }

    public function data()
    {
        $users = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('courses', 'users.course_id', '=', 'courses.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.admission_staff_no', 'courses.course','users.email', 'users.created_at')
            ->where('roles.name', 'student')
            ->get();

        return Datatables::of($users)
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.students.edit', [$row->id]).'" class="btn btn-info btn-circle"
                      data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                      <a href="' . route('admin.students.supervisor', [$row->id]) . '" class="btn btn-success btn-circle"
                      data-toggle="tooltip" data-original-title="View Student Details"><i class="fa fa-search" aria-hidden="true"></i></a>

                      <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-user-id="'.$row->id.'" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
            })
            ->editColumn(
                'name',
                function ($row) {
                    return '<a href="'.route('admin.students.supervisor', $row->id).'">'.ucfirst($row->name).'</a>';
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

    public function export() {
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
                            'courses.course',
                            'users.created_at'
                        )
                    ->where('roles.name', 'student')
                    ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $exportArray = [];

        // Define the Excel spreadsheet headers
        $exportArray[] = ['ID', 'Name','Admission','Email','Phone', 'Faculty', 'Course', 'Created at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {
            $exportArray[] = $row->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('Students', function($excel) use ($exportArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Students');
            $excel->setCreator('PFPMS')->setCompany('MMU');
            $excel->setDescription('Students file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($exportArray) {
                $sheet->fromArray($exportArray, null, 'A1', false, false);

                $sheet->row(1, function($row) {

                    // call row manipulation methods
                    $row->setFont(array(
                        'bold'       =>  true
                    ));

                });

            });



        })->download('xlsx');
    }
    public function addFaculty(Request $request){
        if($request->ajax()){
            return response(Faculty::create(['faculty'=>$request->faculty]));
        }

    }
    public function  addCourse(Request $request){
        if($request->ajax()){
            return response(Course::create(['faculty_id'=>$request->faculty_id, 'course'=>$request->course]));
        }
    }
    public function getCourses(Request $request){
        if($request->ajax()){
            //return response($request->all());
            return response(Course::where('faculty_id',$request->faculty_id)->get());
        }

    }
    public function showstudent($id) {

        $this->client = User::find($id);

        $this->supervisor=$this->client->student->supervisor;
        return view('admin.students.supervisor', $this->data);
    }
}
