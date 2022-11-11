<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Framework\MockObject\Builder\Stub;


class StudentController extends Controller
{
    //* melihat semua Data 
    public function index() {
        $studen = Student::all();
        $row = $studen->count();
        if($row != null) {
            $data = [
            "message" => "View all Student Data !",
            "post" => $studen
            
        ];
        return response()->json($data, 200);        
    } else {
        $data = [
            "message" => "Not Found",
            ];
            return response()->json($data, 404);        

        }
    }


    //* Detail sesuai dengan id
    public function show($id)
    {
        # cari data student
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'Get detail student',
                'post' => $student,
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
    
    //* Menambah Data 
    public function store(Request $request) {
       $inputValidate = $request->validate([
        "nama" => "required",
        "nim" => "numeric|required",
        "email" => "email|required",
        "jurusan" => "required"
       ]);
           $studen = Student::create($inputValidate);
    
           $data = [
            "message" => "Student is cteated successfully",
            "post" => $studen
           ];
    
           return response()->json($data, 201);
        
    }
    
    //* Menghapus data
    public function destroy($id)
    {
        # cari data student yg ingin dihapus
        $student = Student::find($id);

        if ($student) {
            # hapus data student
            $student->delete();

            $data = [
                'message' => 'Student is deleted',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }




    //* Update data 
    public function update(Request $request, $id)
    {
        # cari data student yg ingin diupdate
        $student = Student::find($id);

        if ($student) {
            # mendapatkan data request
            $inputValidate = $request->validate([
                // rules
                "nama" => "required",
                "nim" => "numeric|required",
                "email" => "email|required",
                "jurusan" => "required"
            ]); 
                
            
            # mengupdate data
            $student->update($inputValidate);

            $data = [
                'message' => 'Resource student updated',
                'post' => $student,
            ];

            # mengirimkan respon json dgn status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
}

