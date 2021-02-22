<?php


namespace App\Http\Controllers;
/*
 * CRUD
 */

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Company;
use App\Models\Review;
use App\Models\User;
use App\Models\Specialization;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use File;
use Gate;


class MainController extends Controller
{

    // nurodom kad metodai pasiekiami tik prisijungusiam vartotojui, bet isvardinam isimtis
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'showFull']]);
    }

    public function index()
    {
        $posts = DB::table('posts')
            ->join('companies', 'posts.company_id', '=', 'companies.id')
            ->join('specializations', 'posts.specialization_id', '=', 'specializations.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->leftJoin('reviews as reviews', 'posts.id', '=', 'reviews.post_id')
            ->select('posts.*', 'companies.company_name', 'specializations.specialization_name',
                'users.name', DB::raw('AVG(reviews.rating) as ratings_average'),
                DB::raw('COUNT(reviews.rating) AS no_of_reviews'))
            ->groupBy('posts.id', 'companies.company_name', 'specializations.specialization_name', 'users.name', 'reviews.post_id')
            ->orderBy('no_of_reviews', 'DESC')
            ->paginate(8);

        $companies  = Company::all();
        $specializations  = Specialization::all();
        $cities = DB::table('posts')->select('posts.city')->distinct()->get();
        $genders = DB::table('posts')->select('posts.gender')->distinct()->get();

        return view('pages.home', compact('posts', 'specializations', 'companies',
            'cities', 'genders'));
    }


    public function addPost()
    {

        $companies = Company::all();
        $specializations = Specialization::all();
        return view('pages.add-post', compact('companies', 'specializations'));
    }
    public function store( Post $post, Request $request){
        $validation = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'specialization' => 'required',
            'company' => 'required',
            'city' => 'required',
            'description' => 'required',

        ]);

        if (request()->hasFile('img')) {
            $path = $request->file('img')->store('public/images');
            $filename = str_replace('public/', "", $path);
            Post::create([
                'first_name' => request('firstName'),
                'last_name' => request('lastName'),
                'gender' => request('gender'),
                'specialization_id' => request('specialization'),
                'company_id' => request('company'),
                'city' => request('city'),
                'description' => request('description'),
                'user_id' => Auth::id()
            ]);

        }

    }

    public function showFull(Post $post)
    {
        $posts = DB::table('posts')
            ->join('companies', 'posts.company_id', '=', 'companies.id')
            ->join('specializations', 'posts.specialization_id', '=', 'specializations.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'companies.company_name', 'specializations.specialization_name', 'users.name')
            ->where('posts.id', $post->id)
            ->get();

        $comments = DB::table('reviews')
            ->join('posts', 'posts.id', '=', 'reviews.post_id')
            ->select('reviews.rating', 'reviews.comment', 'reviews.created_at')
            ->where('posts.id', $post->id)
            ->get();

        $rating = DB::table('reviews')
            ->join('posts', 'posts.id', '=', 'reviews.post_id')
            ->select([DB::raw('AVG(reviews.rating) as ratings_average'), DB::raw('COUNT(reviews.rating) AS no_of_reviews')])
            ->where('posts.id', $post->id)
            ->orderBy('no_of_reviews', 'DESC')
            ->groupBy('post_id', 'reviews.post_id')
            ->get();

        return view('pages.posts', compact('posts', 'comments', 'rating'));
    }

    public function editPost(Post $post, Request $request)
    {
        if (Gate::allows('update', $post)) {
            $companies = Company::all();
            $specializations = Specialization::all();
            return view('pages/edit-post', compact('companies', 'specializations', 'post'));
        }
        return redirect()->back()->with(['message' => "You can't edit this post!", 'alert' => 'alert-danger']);
    }

    public function storeUpdate(Request $request, Post $post)
    {
        if ($request->file()) {
            File::delete(storage_path('app/public/', $post->img));
            $path = $request->file('img')->store('public/images');
            $filename = str_replace('public/', "", $path);
            Post::where('id', $post->id)->update(['img' => $filename]);
        }

        Post::where('id', $post->id)->update($request->only(['first_name', 'last_name', 'gender', 'specialization_id',
            'company_id', 'city', 'description']));

        return redirect('/post/' . $post->id)->with(['message' => 'Post was edited',
            'alert' => 'alert-success']);
    }

    public function delete(Post $post)
    {
        if (Gate::allows('delete', $post)) {
            $post->delete();
            return redirect('/')->with(['message' => "Post was deleted", 'alert' => 'alert-danger']);
        }
        return redirect()->back()->with(['message' => "You can't delete this post!", 'alert' => 'alert-danger']);
    }


}
