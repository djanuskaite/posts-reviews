@extends('main')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                {{ session('message') }}
            </div>
        @endif
        @include('_partials/errors')
        @foreach($posts as $post)
            @if(Auth::check())
                <div class="row d-flex justify-content-start delEd">
                    <a href="/edit/post/{{$post->id}}" class="mr-3 btnEd btn-lg">Edit</a>
                    <a onclick="return confirm('Are you sure you want to delete this post?')"
                       href="/delete/post/{{$post->id}}" class="btnDel btn-lg">Delete</a>
                </div>
            @endif
            <div class="row mx-auto container2 d-flex justify-content-center">
                <div class="col-lg-3 col-md-5">
                    @if($post->img)
                        <img src="/{{$post->img}}" alt="profile image" style="width: 250px"/>
                    @elseif($post->gender == 'vyras')
                        <img src="https://www.pinclipart.com/picdir/middle/116-1168985_male-icon-1stacy-dreher2017-08-01t16-business-clipart.png"
                             alt="profile image"
                             style="width: 250px"/>
                    @else
                        <img src="http://assets.stickpng.com/images/585e4bc4cb11b227491c3395.png"
                             alt="profile image"
                             style="width: 250px"/>
                    @endif
                </div>

            </div>

                <div class="row d-flex justify-content-center">
                <div class="col col-lg-3 col-md-5 text-center">
                    <h3>{{ucfirst($post->first_name)}} {{ucfirst($post->last_name)}}</h3>
                   <h5>{{ucfirst($post->specialization_name)}}</h5>
                    <h5>{{ucfirst($post->company_name)}}</h5>
                    <h5>{{ucfirst($post->city)}}</h5>
                </div>
                </div>


            <div class="row mt-1 mb-2 ml-3 d-flex justify-content-end"><p>
                    <strong> Rating:</strong>
                    @if(!!empty($rating))
                        @foreach($rating as $value)
                            @for ($i = 0; $i < 5; $i++)
                                @if (floor($value->ratings_average) - $i >= 1)
                                    Full Start
                                    <i class="fas fa-star text-warning"> </i>
                                @elseif ($value->ratings_average - $i > 0)
                                    Half Start
                                    <i class="fas fa-star-half-alt text-warning"> </i>
                                @else
                                    Empty Start
                                    <i class="far fa-star text-warning"> </i>
                                @endif
                            @endfor
                            <span>({{$value->no_of_reviews}})</span></p>
                @endforeach
                @else
                    @for ($i = 0; $i < 5; $i++)
                        <i class="far fa-star text-warning"> </i>
                    @endfor
                @endif
            </div>

            <div class="row mx-3 d-flex justify-content-center text-center">
                <p>{{$post->description}}</p>
                <h6 class="mt-4 mb-4">Created by <span class="font-italic">{{$post->name}} </span>
                    {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h6>
            </div>
            <div class="border p-4">
                <form method="post" id="" action="/review">
                    {{csrf_field()}}
                    <div class="stars">
                        <input type="radio" id="r1" name="rating" value="5" style="display:none">
                        <label for="r1">&#9733;</label>
                        <input type="radio" id="r2" name="rating" value="4" style="display:none">
                        <label for="r2">&#9733;</label>
                        <input type="radio" id="r3" name="rating" value="3" style="display:none">
                        <label for="r3">&#9733;</label>
                        <input type="radio" id="r4" name="rating" value="2" style="display:none">
                        <label for="r4">&#9733;</label>
                        <input type="radio" id="r5" name="rating" value="1" style="display:none">
                        <label for="r5">&#9733;</label>
                    </div>
                    <div class="form-group">
                        <label>Leave a comment:</label>
                        <textarea type="text" name="comment" rows="3" class="form-control"></textarea>
                    </div>
                    <input type="text" name="post_id" value="{{$post->id}}" hidden>

                    <div class="col-3">
                        <button type="submit" class="btnCom" id="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        @endforeach
        <div class="mt-3">
            <h4 class="font-weight-bolder">Comments:</h4>
            <hr class="mt-0"/>
            <div>
                @foreach($comments as $comment)
                    @if($comment->comment)
                        <div>
                            <p class="font-italic">{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
                            <p>{{$comment->comment}}</p></div>
                        <hr/>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

<style>
    .container2 {
        margin-top: 3em;
    }
    .btnCom {
        background-color: #CBC1B5;
        padding-left: 2em;
        padding-right: 2em;
    }
    .delEd {
        margin-top: 5em;
    }

    .btnEd {
        background-color: #4E341B;
        color: white;
    }

    .btnDel {
        background-color: #CBC1B5;
        color: #4E341B;
    }

    .alert {
        margin-top: 8em;
    }
</style>
