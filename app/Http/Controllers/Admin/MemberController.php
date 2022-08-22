<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Student;
use App\Exports\MembersExport;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
	public function index()
	{
		$datas = Student::paginate(15);

		return view('admin.exam.member')->with([
			'title' => 'Member',
			'datas' => $datas
		]);
	}

	public function export() 
    {
        return Excel::download(new MembersExport, 'users.xlsx');
    }
}
