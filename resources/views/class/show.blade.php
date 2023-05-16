@extends('layouts.app')

@section('template_title')
    {{ $class->name ?? "{{ __('Show') Class" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Class</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('classes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nom:</strong>
                            {{ $class->nom }}
                        </div>
                        <div class="form-group">
                            <strong>Capacity:</strong>
                            {{ $class->capacity }}
                        </div>
                        <div class="form-group">
                            <strong>Niveau Scolaire Id:</strong>
                            {{ $class->niveau_scolaire_id }}
                        </div>
                        <div class="form-group">
                            <strong>Emploi Id:</strong>
                            {{ $class->emploi_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
