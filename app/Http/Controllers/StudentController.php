<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use \Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        if($students->count() > 0){
            return response()->json([
                "status"=>200,
                'students' => $students
            ],200);

        }
        else {
            return response()->json([
                "status" => 404,
                'students' => 'No Records found'
            ], 404);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
          'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors() // Change 'message()' to 'errors()'
            ], 422);
        }
        else{
            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            if ($student) {
                return response()->json([
                    "status" => 200,
                    'students' => 'student created successfully'
                ], 200);
            }
            else{
                return response()->json([
                    "status" => 500,
                    'students' => 'something went wrong'
                ], 500);

            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        if($student) {
             return response()->json([
                    "status" => 200,
                    'students' => $student
                ], 200);
        }else{
            return response()->json([
                "status" => 404,
                'students' => 'No data found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                "status" => 200,
                'students' => $student
            ], 200);
        } else {
            return response()->json([
                "status" => 404,
                'students' => 'No data found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors() // Change 'message()' to 'errors()'
            ], 422);
        } else {
            $student = Student::find($id);

            if ($student) {
                $student->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                return response()->json([
                    "status" => 200,
                    'students' => 'student updated successfully'
                ], 200);
            } else {
                return response()->json([
                    "status" => 404,
                    'students' => 'no student found'
                ], 404);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();

            return response()->json([
                "status" => 200,
                'students' => 'student deleted successfully'
            ], 200);
        } else {
            return response()->json([
                "status" => 404,
                'students' => 'no student found'
            ], 404);
        }
    }

}
