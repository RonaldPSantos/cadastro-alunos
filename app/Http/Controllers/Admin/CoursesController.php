<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CoursesController extends Controller
{
    private $courses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Course $course)
    {
        $this->Course = $course;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Course::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($course) {

                    $action = '<a href="' . route('admin.courses.edit', ['course' => $course->id]) . '" class="btn btn-success" id="edit-course" data-id=' . $course->id . '>EDITAR </a>';
                    $action .= '<meta name="csrf-token" content="{{ csrf_token() }}">';
                    $action .= '<a id="delete-course" data-id=' . $course->id . ' class="btn btn-danger delete-course">REMOVER</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
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

        $this->Course->create($data);

        flash('Curso cadastrado com sucesso');
        return view('admin.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $course
     * @return \Illuminate\Http\Response
     */
    public function show($course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($course)
    {
        $course = $this->Course->findOrFail($course);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course)
    {
        $data = $request->all();
        
        $course = $this->Course->find($course);
        $course->update($data);
        
        flash('Curso atualizado com sucesso');
        return view('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course)
    {
        //
    }
}
