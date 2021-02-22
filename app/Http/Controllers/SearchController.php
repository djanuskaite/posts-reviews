<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Post;
use App\Models\Specialization;

class SearchController extends Controller
{
    public function index(Request $request){

        $posts = DB::table('posts')
            ->join('companies', 'posts.company_id', '=', 'companies.id')
            ->join('specializations', 'posts.specialization_id', '=', 'specializations.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->leftJoin('reviews as reviews', 'posts.id', '=', 'reviews.post_id')
            ->select('posts.*', 'companies.company_name', 'specializations.specialization_name', 'users.name',
                DB::raw('ROUND(AVG(reviews.rating)) as ratings_average'), DB::raw('COUNT(reviews.rating) AS no_of_reviews'))
            ->groupBy('posts.id', 'companies.company_name', 'specializations.specialization_name', 'users.name', 'reviews.post_id');
        $companies  = Company::all();
        $specializations  = Specialization::all();
        $cities = DB::table('posts')->select('posts.city')->distinct()->get();
        $genders = DB::table('posts')->select('posts.gender')->distinct()->get();

        if ($request->filled('company_name')){
            $posts->where('company_name', $request->company_name);
        }
        if ($request->filled('specialization_name')){
            $posts->where('specialization_name', $request->specialization_name);
        }
        if ($request->filled('city')){
            $posts->where('city', $request->city);
        }
        if ($request->filled('gender')){
            $posts->where('gender', $request->gender);
        }
        if ($request->filled('search')) {
            $posts->where('first_name', 'LIKE',  '%'  . $request->search . '%')
                ->orWhere('last_name','LIKE',  '%' . $request->search . '%')
                ->orWhere('specialization_name', 'LIKE',  '%' .$request->search . '%');
        }
        if ($request->filled('rating')) {
            $posts->having(DB::raw('ROUND(AVG(reviews.rating))'), $request->rating);

        }
        return view('pages.searched-results', ['posts' => $posts->paginate(8)], compact( 'specializations', 'companies',
            'cities', 'genders'));
    }
}
