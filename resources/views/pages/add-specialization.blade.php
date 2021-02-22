@extends('main')

@section('content')

    <div class="row justify-content-center addSpec mb-4">
        <h2 class="text-secondary">Add specialization</h2>
    </div>

    <form action="/spec" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" id="title" placeholder="Enter specialization" name="specialization">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-lg" id="addSpec">Add</button>
        </div>

    </form>

    <div class="text-right">
        <a href="/all-specializations" class="alert-secondary allSpec">--> Show all specializations</a>
    </div>


@endsection

<style>
    .addSpec {
        margin-top: 10em;
    }

    #addSpec {
        background-color: #4E341B;
        color: #f4f4f4;
    }

    .allSpec {
        font-size: medium;
    }

</style>
