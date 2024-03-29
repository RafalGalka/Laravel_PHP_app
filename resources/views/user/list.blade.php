@extends('layout.main')

@section('content')
<div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Lista użytkowników</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nick</th>
                        <th>Firma</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Lp</th>
                        <th>Id</th>
                        <th>Nick</th>
                        <th>Opcje</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user->client->short_name }}</td>
                        <td>
                            @can('view', $user)
                            <a href="{{ route('get.user.show', ['userId' => $user['id']]) }}">Szczegóły</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
