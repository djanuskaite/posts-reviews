@extends('main')

@section('content')

    <div class="row justify-content-center addComp mb-4">
        <h2 class="text-secondary">Add company</h2>
    </div>

    <form action="/comp" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" id="title" placeholder="Enter company" name="company">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-lg" id="addComp">Add</button>
        </div>

    </form>

    <div class="text-right">
        <a href="/all-companies" class="alert-secondary allComp">--> Show all companies</a>
    </div>


@endsection

<style>
  .addComp {
      margin-top: 10em;
  }

  #addComp {
      background-color: #4E341B;
      color: #f4f4f4;
  }

  .allComp {
      font-size: medium;
  }

</style>
