<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{

    // Get Functions
    public function index()
    {
        # Get all data from Student DB
        $all_students = Student::get();

        return view('students', compact('all_students'));
    }


    // Create Function
    public function store(Request $request)
    {
        # Logging the request data from the form
        # dd($request->input());

        # Validation
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        # Image File Handling
        $ext = $request->file('photo')->extension();
        $file_name = 'pjk-dev' . '-' .  date('dmYHis') . '.' . $ext;

        # This will upload inside the directory
        $request->file('photo')->move(public_path('uploads/'), $file_name);



        # Save into DB
        $student = new Student();
        $student->photo = $file_name;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();

        # After saving the data return back to home page and show success
        return redirect()->route('home')->with('success', 'Your data is added successfully. 🥳');
    }

    // Edit
    public function edit($id)
    {
        # dd($id);
        # Get specific data from the DB
        $single_student = Student::where('id', $id)->first();

        return view('edit', compact('single_student'));
    }

    // Update Function
    public function update(Request $request, $id)
    {
        # dd($request->input());

        # Get a specific data id from DB
        $student = Student::where('id', $id)->first();

        # Check validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        # Check if the photo is already existed
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            # Delete existing image
            if (file_exists(public_path('uploads/' . $student->photo)) and !empty($student->photo)) {
                unlink(public_path('uploads/' . $student->photo));
            }

            # Upload a new photo
            $ext = $request->file('photo')->extension();
            $file_name = 'pjk-dev' . '-' .  date('dmYHis') . '.' . $ext;

            $request->file('photo')->move(public_path('uploads/'), $file_name);
            # 
            $student->photo  = $file_name;
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->update();

        return redirect()->route('home')->with('success', 'Your data is successfully updated. 😎');
    }

    // Delete Function
    public function delete($id)
    {
        $student = Student::where('id', $id)->first();

        # If file is existed then delete it
        if (file_exists(public_path('uploads/' . $student->photo)) and !empty($student->photo)) {
            unlink(public_path('uploads/' . $student->photo));
        }

        # Delete the row data
        $student->delete();

        return redirect()->back()->with('success', 'You has been deleted this student 🥹');
    }
}
