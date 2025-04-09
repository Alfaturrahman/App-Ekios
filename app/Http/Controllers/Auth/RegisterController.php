<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $departments = Department::all();
        $jabatans = Jabatan::all();
        return view('auth.register', compact('departments', 'jabatans'));

    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'employee_name'  => 'required|string|max:255',
            'employee_badge' => 'required|string|unique:tbl_employee,employee_badge',
            'password'       => 'required|string|min:6|confirmed',
            'department_id'  => 'required|exists:tbl_department,department_id',
            'jabatan_id'     => 'required|exists:tbl_jabatan,jabatan_id',
        ]);

        $employee = Employee::create([
            'employee_name'  => $validated['employee_name'],
            'employee_badge' => $validated['employee_badge'],
            'password'       => bcrypt($validated['password']),
            'department_id'  => $validated['department_id'],
            'jabatan_id'     => $validated['jabatan_id'],
        ]);

        Auth::login($employee);
        return redirect('/');
    }

}
