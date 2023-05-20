@extends('layouts.app')

@section('template_title')
    {{ $elefe->name ?? "{{ __('Show') Elefe" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Elefe</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('eleves.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nom Francais:</strong>
                            {{ $elefe->nom_francais }}
                        </div>
                        <div class="form-group">
                            <strong>Nom Arabe:</strong>
                            {{ $elefe->nom_arabe }}
                        </div>
                        <div class="form-group">
                            <strong>Prenom Francais:</strong>
                            {{ $elefe->prenom_francais }}
                        </div>
                        <div class="form-group">
                            <strong>Prenom Arabe:</strong>
                            {{ $elefe->prenom_arabe }}
                        </div>
                        <div class="form-group">
                            <strong>Date Naissance:</strong>
                            {{ $elefe->date_naissance }}
                        </div>
                        <div class="form-group">
                            <strong>Lieu Naissance:</strong>
                            {{ $elefe->lieu_naissance }}
                        </div>
                        <div class="form-group">
                            <strong>Sex:</strong>
                            {{ $elefe->sex }}
                        </div>
                        <div class="form-group">
                            <strong>Photo:</strong>
                            {{ $elefe->photo }}
                        </div>
                        <div class="form-group">
                            <strong>Cne:</strong>
                            {{ $elefe->CNE }}
                        </div>
                        <div class="form-group">
                            <strong>Classe Id:</strong>
                            {{ $elefe->classe_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $elefe->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
