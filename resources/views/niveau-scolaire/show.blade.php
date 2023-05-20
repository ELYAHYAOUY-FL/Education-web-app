@extends('layouts.app')

@section('template_title')
    {{ $niveauScolaire->name ?? "{{ __('Show') Niveau Scolaire" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Niveau Scolaire</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('niveau-scolaires.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nom:</strong>
                            {{ $niveauScolaire->nom }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $niveauScolaire->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
