<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \App\Student;
use PHPUnit\Framework\MockObject\Builder\Stub;

class PhotoController extends Controller
{
    public function removePhoto(Request $request)
    {
        //$data = $request->all();
        $photoName = $request->get('photoName');
        
        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }
        
        $removePhoto = Student::where('photo', $photoName);
        $student_id = $removePhoto->first()->id;
        
        $data['photo'] = null;
        $removePhoto->update($data);
        
        //flash('Imagem removida com sucesso')->success();
        //dd($student_id);
        //die;
        return redirect()->route('admin.students.edit', ['student' => $student_id]);
    }
}
