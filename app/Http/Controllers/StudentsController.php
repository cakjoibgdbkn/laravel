<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function index() {
        $students = \App\Models\Student::all()->sortBy("name");

        return view('students/index', [
            'students' => $students,
            'pageTitle' => 'Студенти груп 308, 309',
        ]);
    }

    public function getList() {
        return \App\Models\Student::all();
    }

    public function create(){
        return view('students/create');
    }
/*
    public function store(){
        \App\Models\Student::create([
            'name' => \request('stud-name'),
            'group' => \request('stud-group'),
        ]);
        return redirect('/students');
    }
*/
    public function store(){
        $data = request() ->validate([
            'stud-name' as ['required', 'max:50'],
            'stud-group' as 'required|min:3|max:5',
        ], [
            'stud-name.required' => 'Прізвище студента має бути заповнено!',
            'stud-name.max' => 'Довжина не має перевищувати 50 символів',
            'stud-group.required' => 'Номер групи не може бути порожнім!',
            'stud-group.min' => 'Номер групи не може бути менше 3 символів!',
            'stud-group.max' => 'Номер групи не може бути більше 5 символів!',
        ]);
        \App\Models\Student::create([
            'name' => data['stud-name'],
            'group' => data['stud-group'],
        ]);
        return redirect('/students');
    }

    public function edit(Student $student){
        return view('students/edit',[
            'student' => $student,
        ]);
    }

    public function update(Student $student){
        $student->update(
            request() ->validate([
                'name' as ['required', 'max:50'],
                'group' as 'required|min:3|max:5',
            ], [
                'name.required' => 'Прізвище студента має бути заповнено!',
                'name.max' => 'Довжина не має перевищувати 50 символів',
                'group.required' => 'Номер групи не може бути порожнім!',
                'group.min' => 'Номер групи не може бути менше 3 символів!',
                'group.max' => 'Номер групи не може бути більше 5 символів!',
            ])
        );
        $student->save();
        return redirect('/students');
    }

    public function destroy(Student $student){
        $student->delete();
    }

    public function show(\App\Models\Student $student){
        return view('students/show', [
            'student' => $student
        ]);
    }
}

//\App\Models\Student
