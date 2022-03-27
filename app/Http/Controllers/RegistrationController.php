<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Service\Username;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index(Request $request) {

        $user = Auth::user();

        $employees = Employee::orderBy('created_at', 'asc')
            ->where('role', Employee::EMPLOYEE);

        if(isset($request->employee_name)) {
            $employees
                ->where(DB::raw('lower(employee_name)'), 'LIKE', '%'.strtolower($request->employee_name).'%');
        }

        $employees = collect($employees->paginate(5));

        return view('contents.admin.registration')
            ->with('user', $user)
            ->with('employees', $employees);
    }

    public function create(Request $request) {

        $employee = new Employee;

        $username = Username::generateUsername($request->employee_name);
        $employee->employee_name = $request->employee_name;
        $employee->username = $username;
        $employee->password = Hash::make($username);
        $employee->phone = $request->phone;
        $employee->role = Employee::EMPLOYEE;

        $employee->save();

        return redirect()
            ->back()
            ->with('success-create', "Sukses menambahkan akun dengan username <b>$username</b> dan password <b>$username</b>");
    }

    public function detail(Request $request) {

        $employee = Employee::findOrFail($request->id);

        return response()->json($employee);
    }

    public function update(Request $request) {

        $employee = Employee::findOrFail($request->id);

        $employee->employee_name = $request->employee_name;
        $employee->phone = $request->phone;

        $employee->save();

        return redirect()
        ->back()
        ->with('success-edit', "Sukses memperbarui akun");
    }

    public function delete(Request $request) {
        Employee::findOrFail($request->id)->delete();

        return response()->json('ok');
    }
}
