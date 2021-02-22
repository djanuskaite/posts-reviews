<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function addSpecialization()
    {
        return view('pages.add-specialization');
    }

    public function toAddSpecialization(Request $request)
    {
        $validaton = $request->validate([
            'specialization' => 'required'
        ]);

        Specialization::create([
            'specialization_name' => request('specialization')
        ]);

        return redirect('/add-post');
    }

    public function showSpec(Specialization $specialization){
        $specialization = Specialization::all();
        return view('pages/all-specializations', compact('specialization')); // paimk visas kategorijas is lenteles
    }

    public function deleteSpec(Specialization $specialization){

        $specialization->delete();

        return redirect('/all-specializations');
    }

}
