@extends('layouts.app')

@section('template_title')
    Elefe
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Elefe') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('eleves.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nom Francais</th>
										<th>Nom Arabe</th>
										<th>Prenom Francais</th>
										<th>Prenom Arabe</th>
										<th>Date Naissance</th>
										<th>Lieu Naissance</th>
										<th>Sex</th>
										<th>Photo</th>
										<th>Cne</th>
										<th>Classe Id</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eleves as $elefe)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $elefe->nom_francais }}</td>
											<td>{{ $elefe->nom_arabe }}</td>
											<td>{{ $elefe->prenom_francais }}</td>
											<td>{{ $elefe->prenom_arabe }}</td>
											<td>{{ $elefe->date_naissance }}</td>
											<td>{{ $elefe->lieu_naissance }}</td>
											<td>{{ $elefe->sex }}</td>
											<td>{{ $elefe->photo }}</td>
											<td>{{ $elefe->CNE }}</td>
											<td>{{ $elefe->classe_id }}</td>
											<td>{{ $elefe->user_id }}</td>

                                            <td>
                                                <form action="{{ route('eleves.destroy',$elefe->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('eleves.show',$elefe->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('eleves.edit',$elefe->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $eleves->links() !!}
            </div>
        </div>
    </div>
@endsection
