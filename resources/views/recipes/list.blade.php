@extends('layout.main')

@section('content')
    <div class="card mt-3">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Receptury</div>
        <div class="card-body">

            <form class="form-inline" action="{{ route('tables.invest') }}">
                <div class="form-row">
                    <div class="col-auto">
                        <a href="{{ route('recipes.recipeAdd') }}" role="button" class="btn btn-primary mb-1 ml-2">Dodaj nową recepturę</a>
                    </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Lp</th>
                            <th>Klasa wytrz.</th>
                            <th>Nr receptury</th>
                            <th>Aktywna</th>
                            <th>Szczegóły</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipe ?? [] as $recip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recip->strenght_class }}</td>
                                <td>{{ $recip->recipe_number }}</td>
                                <td>
                                    @if ($recip->activ == 1)
                                        TAK
                                    @else
                                        NIE
                                    @endif
                                </td>
                                <td>
                                    <a href="recipes/rec/ {{ $recip->id }}">Szczegóły
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $recipe->links() }}
        </div>

    </div>
@endsection
