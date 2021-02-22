@extends('main')

@section('content')

    <div class="row justify-content-center mt-3 mb-4">
        <h2>Edit your post</h2>
    </div>
    @include('_partials/errors')
    <form method="post" action="/storeupdate/{{$post->id}}" enctype="multipart/form-data" class="mt-2">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputFirstName">First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="First name" name="firstName">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Last name" name="lastName">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select id="inputGender" class="form-control" name="gender">
                    <option name="gender" selected>Choose...</option>
                    <option>Female</option>
                    <option>Male</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputSpecialization">Specialization</label>
                <select class="form-control" id="inputSpecialization" name="specialization">
                    <option name="specialization" value="" disabled selected>Choose specialization</option>
                    @foreach($specializations as $specialization)
                        <option value={{$specialization->id}}>{{$specialization->specialization_name}}</option>
                    @endforeach
                </select>
                <p>Didn't find your specialization?<a href="/add-specialization"> Add specialization</a></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCompany">Company</label>
                <select class="form-control" id="inputCompany" name="company">
                    <option name="company" value="" disabled selected>Choose company</option>
                    @foreach($companies as $company)
                        <option value={{$company->id}}>{{$company->company_name}}</option>
                    @endforeach
                </select>
                <p>Didn't find your company?<a href="/add-company"> Add company</a></p>
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city">
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="5" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="upload">Choose a picture:</label>
            <input type="file" class="form-control" id="upload"  name="img">
        </div>
        <div class="form-group d-flex justify-content-center m-5">
            <button type="submit" class="btn btn-lg" id="addPostbtn" name="post">Post</button>
        </div>
    </form>

@endsection

<style>
    #addPostbtn {
        background-color: #4E341B;
        color: #f4f4f4;
    }
</style>
