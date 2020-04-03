<?php

namespace App\Http\Controllers\Course_Rep;
use App\Http\Controllers\Controller;
use App\Course_Rep\Student\Student;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Course_Rep_Controller extends Controller
{
    
    /**
     * Returns all the students in the database
     * I wrote this method so as to avoid repeting the same process in other Controllers
     * @return array $all_students;
     */

    protected function get_all_students()
    {
        $all_students = Student::all();
        return $all_students;
    }


    /**
     * This fetches the current user profile details
     * 
     */
    
    protected function get_profile()
    {
        $id = Auth::id();
        $profile = User::where('id', $id)->first();
        return $profile;
    }
    
    

    public function __construct()
    {
        $this->middleware('course_rep');
    }

    public function index()
    {
        $all_students = Student::all(); 
        
        return view('course_rep.index', compact('all_students', $all_students));
    }

}
