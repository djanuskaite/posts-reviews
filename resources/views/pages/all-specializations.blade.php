@extends('main')

@section('content')

    <div class="row justify-content-center mb-5">
        <h2 class="text-secondary">All specializations</h2>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Specialization</th>
            <th scope="col"><i class="fas fa-minus-circle"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($specialization as $specializations)
            <tr>
                <td><a href="/company/{{$specializations->id}}">{{$specializations->specialization_name}}</a></td>
                <td><a href="/delete/specialization/{{$specializations->id}}">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
