<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function addCompany()
    {
        return view('pages.add-company');
    }

    public function toAddCompany(Request $request)
    {
        $validaton = $request->validate([
            'company' => 'required'
        ]);

        Company::create([
            'company_name' => request('company')
        ]);

        return redirect('/add-post');
    }

    public function showComp(Company $company){
        $company = Company::all();
        return view('pages/all-companies', compact('company')); // paimk visas kategorijas is lenteles
    }

    public function deleteComp(Company $company){

        $company->delete();

        return redirect('/all-companies');
    }

}
