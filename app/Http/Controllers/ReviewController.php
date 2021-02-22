<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addingReview(Request $request){
        $validation = $request->validate([
            'rating'=> 'required'
        ]);

        Review::create([
            'rating'=>request('rating'),
            'comment'=>request('comment'),
            'post_id'=>request('post_id'),
            'user_id'=>Auth::id()
        ]);

        return redirect()->back()->with(['message' => "A new review was added", 'alert' => 'alert-warning']);
    }

}
