<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        $jwt_token = session('jwt_token');
        $userCount = DB::table('users')->count();
        $jobCount = DB::table('jobs')->count();
        $deptCount = DB::table('departments')->count();
        return view('admin.dashboard', compact('jwt_token', 'userCount', 'jobCount', 'deptCount'));
        // return view('admin.dashboard', [
        //     'userCount' => $userCount,
        //     'jobCount' => $jobCount,
        //     'deptCount' => $deptCount,
        //     'jwt_token' => $jwt_token,
        // ]);
    }
    public function user()
    {
        $users = User::paginate(10);

        return view(
            'admin.user',
            [
                "users" => $users,
            ]
        );
    }
    public function userEdit(Request $request)
    {
        $user = User::whereId($request->id)->first(); // easier readability

        $status = "";
        // post/get parameter 'name', and save it into database
        if (isset($request->name)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $status = "Record $user->id updated!";
            return redirect('admin/userEdit/' . $user->id)->with('status', $status);
        }

        return view(
            'admin.userEdit',
            [
                "user" => $user
            ]
        )->with("status", $status);
    }
    public function userRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:users|max:255', //ensure to point at the right table in database
                'password' => 'required',
                'email' => 'required|unique:users|email:rfc,dns',
            ]);

            $requestData = $request->except(['password']);
            // $requestData['password'] = Hash::make($request->password);
            $requestData['password'] = bcrypt($request->password);

            // $requestData = $request->fill([
            //     'password' => Hash::make($request->password)
            // ])->save();

            $user = User::create($requestData);
            $status = "New user $user->name has been added!";
            return redirect('admin/userRegister')->with('status', $status);
        }
        return view('admin.userRegister');
    }
    public function userDestroy($id)
    {
        $status = "";
        $user = User::findOrFail($id);
        if ($id == 1) {

            $status = "$user->name ID: $user->id cannot be deleted!";
            return redirect('admin/user')->with('status', $status);
        }
        $status = "";
        $user = User::findOrFail($id);
        $user->delete();

        $status = "Record User ID: $user->id, $user->name has been deleted!";
        return redirect('admin/user')->with('status', $status);
    }
    public function job()
    {
        $jobs = Job::paginate(10);

        return view(
            'admin.job',
            [
                "jobs" => $jobs,
            ]
        );
    }
    public function jobEdit(Request $request)
    {
        $job = Job::whereId($request->id)->first(); // easier readability

        $status = "";
        // post/get parameter 'name', and save it into database
        if (isset($request->title)) {
            $job->title = $request->title;
            $job->description = $request->description;
            $job->min_salary = $request->min_salary;
            $job->max_salary = $request->max_salary;
            $job->save();
            $status = "Record $job->id updated!";
            return redirect('admin/jobEdit/' . $job->id)->with('status', $status);
        }

        return view(
            'admin.jobEdit',
            [
                "job" => $job
            ]
        )->with("status", $status);
    }
    public function jobRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|unique:jobs', //ensure to point at the right table in database
                'description' => 'required',
                'min_salary' => 'required',
                'max_salary' => 'required',
            ]);

            $job = Job::create($request->all());
            $status = "New job title: $job->name has been added!";
            return redirect('admin/jobRegister')->with('status', $status);
        }
        return view('admin.jobRegister');
    }
    public function jobDestroy($id)
    {
        $status = "";
        $job = Job::findOrFail($id);
        $job->delete();

        $status = "Record Job ID: $job->id, $job->title has been deleted!";
        return redirect('admin/job')->with('status', $status);
    }
    public function department()
    {
        $departments = Department::paginate(10);

        return view(
            'admin.department',
            [
                "departments" => $departments,
            ]
        );
    }
    public function departmentEdit(Request $request)
    {
        $department = Department::whereId($request->id)->first(); // easier readability

        $status = "";
        // post/get parameter 'name', and save it into database
        if (isset($request->name)) {
            $department->name = $request->name;
            $department->save();
            $status = "Record $department->id updated!";
            return redirect('admin/departmentEdit/' . $department->id)->with('status', $status);
        }

        return view(
            'admin.departmentEdit',
            [
                "department" => $department,
            ]
        )->with("status", $status);
    }
    public function departmentRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|unique:departments', //ensure to point at the right table in database

            ]);

            $department = Department::create($request->all());
            $status = "Department $department->name has been added!";
            return redirect('admin/departmentRegister')->with('status', $status);
        }
        return view('admin.departmentRegister');
    }
    public function departmentDestroy($id)
    {
        $status = "";
        $department = Department::findOrFail($id);
        $department->delete();

        $status = "Record department ID: $department->id, $department->name has been deleted!";
        return redirect('admin/department')->with('status', $status);
    }
}
