@extends('main')

@section('content')

    <div class="container my-4">
        <form method="get" action="/search" class="row rounded pb-2 pt-4 px-2 d-flex justify-content-between mb-3 homeCont"
              enctype="multipart/form-data">
            <div class="form-group col-lg-2 col-md-4">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search"/>
            </div>
            <div class="form-group col-lg-2 col-md-3">
                <select class="form-control" name="specialization_name">
                    <option value="" disabled selected>Specialization</option>
                    @foreach($specializations as $specialization)
                        <option
                            value="{{$specialization->specialization_name}}">{{ucfirst($specialization->specialization_name)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3">
                <select class="form-control" name="company_name">
                    <option value="" disabled selected>Company</option>
                    @foreach($companies as $company)
                        <option value="{{$company->company_name}}">{{ucfirst($company->company_name)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2">
                <select class="form-control" name="city">
                    <option value="" disabled selected>City</option>
                    @foreach($cities as $city)
                        <option value="{{$city->city}}">{{ucfirst($city->city)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg col-md-3">
                <select class="form-control" name="gender">
                    <option value="" disabled selected>Gender</option>
                    @foreach($genders as $gender)
                        <option value="{{$gender->gender}}">{{ucfirst($gender->gender)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3">
                <select class="form-control" name="rating">
                    <option value="" class="" disabled selected>Rating</option>
                    <option value="5" class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="4" class="text-warning">&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="3" class="text-warning">&#9733;&#9733;&#9733;</option>
                    <option value="2" class="text-warning">&#9733;&#9733;</option>
                    <option value="1" class="text-warning">&#9733;</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn rounded font-weight-bold text-white"><i class="fas fa-search fa-2x"></i></button>
            </div>
        </form>

        @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                {{ session('message') }}
            </div>
        @endif

        @foreach($posts as $post)
            <div class="bg-white col-md-7 mx-auto border col-11 mb-2 mt-5">
                <div class="row p-3">
                    <div class="col-lg-3 col-md-4 col-5">
                        @if($post->img)
                            <img src="/{{$post->img}}" class="home-img" alt="profile image"/>
                        @elseif($post->gender == 'male')
                            <img
                                src="https://www.pinclipart.com/picdir/middle/116-1168985_male-icon-1stacy-dreher2017-08-01t16-business-clipart.png"
                                alt="profile image"
                                class="home-img"/>
                        @else
                            <img src="http://assets.stickpng.com/images/585e4bc4cb11b227491c3395.png"
                                 alt="profile image"
                                 style="width: 95px"/>
                        @endif
                    </div>
                    <div class="col-md-4 col-6 ml-md-3">
                        <div class="row font-weight-bolder"><h5>{{ucfirst($post->first_name)}} {{ucfirst($post->last_name)}}</h5>
                        </div>
                        <div class="row font-weight-bolder">{{ucfirst($post->specialization_name)}}</div>
                        <div class="row font-weight-bolder">{{ucfirst($post->company_name)}}</div>
                        <div class="row font-weight-bolder">{{ucfirst($post->city)}}</div>
                    </div>
                    <div class="col-lg col-12">
                        <div class="row d-flex justify-content-end mt-3">Rating:
                            <div class="align-self-center ml-2">
                                @for ($i = 0; $i < 5; $i++)
                                    @if (floor($post->ratings_average) - $i >= 1)
                                        <i class="fas fa-star text-warning"> </i>
                                    @elseif ($post->ratings_average - $i > 0)
                                        <i class="fas fa-star-half-alt text-warning"> </i>
                                    @else
                                        <i class="far fa-star text-warning"> </i>
                                    @endif
                                @endfor
                                <span>({{$post->no_of_reviews}})</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pl-3 mb-2">
                    <p class="col text-secondary ">
                        Created by: <a href="/user/{{$post->user_id}}" class="font-italic">{{$post->name}} </a>
                        {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
                    <div class="col-3">
                        <button type="submit" class="btn" id="readMore" name="post"><a href="/post/{{$post->id}}" name="readMr">Read more</a></button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-3">
            {{$posts->links()}}
        </div>
    </div>
@endsection

<style>
    .homeCont {
        background-color: #CBC1B5;
        padding: 2em;
        margin-top: 7em;
    }

    #readMore {
        background-color: #CBC1B5;
    }
</style>
