@extends('layouts.app')

@section('template_title')
    {{ $devoir->name ?? "{{ __('Show') Devoir" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Devoir</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('devoirs.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Date Limite:</strong>
                            {{ $devoir->date_limite }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $devoir->description }}
                        </div>
                        <div class="form-group">
                            <strong>Fichier:</strong>
                            {{ $devoir->fichier }}
                        </div>
                        <div class="form-group">
                            <strong>Matiere Id:</strong>
                            {{ $devoir->matiere_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
