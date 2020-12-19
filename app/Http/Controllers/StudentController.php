<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Students;
use DataTables;
class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //check if user is logged in
        $this->middleware('auth');
    }

    /**
     * Show the application student.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       //Load page for listing
        try{
            return view('studentlist');
        }
        catch (Exception $e) {
            \Session::flash('error_message', 'Something went wrong!');
            return redirect()->route('student.index');
        }
    }
    public function getdata(){
        try{
            // get data using ajax and load to listing using ajax, do sorting, paaginatin, search
            return DataTables::of(Students::query())->make(true);
        }
        catch (Exception $e) {
            \Session::flash('error_message', 'Something went wrong!');
            return redirect()->route('student.index');
        }


    }
    public function create(){
        try{
             return view('studentform');
        }
        catch (Exception $e) {
            \Session::flash('error_message', 'Something went wrong!');
            return redirect()->route('student.index');
        }

    }

    public function store(Request $request){

    try{
        // create array of all data
        $data=['name'=>$request['name'],'grade'=>$request['grade'],'city'=>$request['city'],'country'=>$request['country'],'address'=>$request['address'],'dob'=>$request['dob']];


        // Check if file is uploaded and if it is uploaded it is uplaoded to stoarage folder 
        if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
             //dd();
            $request->photo->storeAs('public/Studentphotos', $fileName);
            $data['photo']=$fileName;
        }   

        //Stoare Data in DB
        Students::create($data);

        // Redirect page with success messagee
        \Session::flash('success_message', 'Student details added successfully');
        return redirect()->route('student.index');
    }
    catch (Exception $e) {
        \Session::flash('error_message', 'Something went wrong!');
        return redirect()->route('student.index');
    }

    }
}
