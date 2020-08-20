<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use yajra\DataTables\DataTables;

class StudentsController extends Controller
{
    private $student;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Student $student)
    {
        $this->Student = $student;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($student) {

                    $action = '<a href="' . route('admin.students.edit', ['student' => $student->id]) . '" class="btn btn-success" id="edit-student" data-id=' . $student->id . '>EDITAR </a>';
                    $action .= '<meta name="csrf-token" content="{{ csrf_token() }}">';
                    $action .= '<a id="delete-student" data-id=' . $student->id . ' class="btn btn-danger delete-student">REMOVER</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.students.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = \App\Course::all('id', 'name');
        return view('admin.students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $courses = $request->get('courses', null);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $data['photo'] = $photo->store('students', 'public');
        }

        $student = $this->Student->create($data);

        if (!is_null($courses)) {
            $student->courses()->sync($courses);
        }

        flash('Produto criado com sucesso')->success();
        return view('admin.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($student)
    {
        $courses = \App\Course::all();
        $student = $this->Student->findOrFail($student);
        return view('admin.students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student)
    {
        $data = $request->all();
        $courses = $request->get('courses', null);

        $student = $this->Student->find($student);

        if (!is_null($courses)) {
            $student->courses()->sync($courses);
        }

        if ($request->hasFile('photo')) {
            if (Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }

            $photo = $request->file('photo');
            $data['photo'] = $photo->store('students', 'public');
        }
        $student->update($data);
        flash('Produto alterado com sucesso!')->success();
        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $photoName = $request->get('photoName');

        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }

        $removePhoto = Student::where('photo', $photoName);
        $student_id = $removePhoto->first()->id;

        $data['photo'] = null;
        $removePhoto->update($data);

        //flash('Imagem removida com sucesso')->success();
        return redirect()->route('admin.students.edit', ['student' => $student_id]);
    }
}
