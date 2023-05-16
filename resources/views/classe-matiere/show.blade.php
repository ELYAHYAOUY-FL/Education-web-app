@extends('layouts.app')

@section('template_title')
    {{ $classeMatiere->name ?? "{{ __('Show') Classe Matiere" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Classe Matiere</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('classe-matieres.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Classe Id:</strong>
                            {{ $classeMatiere->classe_id }}
                        </div>
                        <div class="form-group">
                            <strong>Matiere Id:</strong>
                            {{ $classeMatiere->matiere_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
