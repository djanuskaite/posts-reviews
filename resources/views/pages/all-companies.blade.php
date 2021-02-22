@extends('main')

@section('content')

    <div class="row justify-content-center mb-5">
        <h2 class="text-secondary">All companies</h2>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Company</th>
            <th scope="col"><i class="fas fa-minus-circle"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($company as $companies)
            <tr>
                <td><a href="/company/{{$companies->id}}">{{$companies->company_name}}</a></td>
                <td><a href="/delete/company/{{$companies->id}}">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
