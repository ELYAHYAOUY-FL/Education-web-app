<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nom_francais') }}
            {{ Form::text('nom_francais', $elefe->nom_francais, ['class' => 'form-control' . ($errors->has('nom_francais') ? ' is-invalid' : ''), 'placeholder' => 'Nom Francais']) }}
            {!! $errors->first('nom_francais', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nom_arabe') }}
            {{ Form::text('nom_arabe', $elefe->nom_arabe, ['class' => 'form-control' . ($errors->has('nom_arabe') ? ' is-invalid' : ''), 'placeholder' => 'Nom Arabe']) }}
            {!! $errors->first('nom_arabe', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('prenom_francais') }}
            {{ Form::text('prenom_francais', $elefe->prenom_francais, ['class' => 'form-control' . ($errors->has('prenom_francais') ? ' is-invalid' : ''), 'placeholder' => 'Prenom Francais']) }}
            {!! $errors->first('prenom_francais', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('prenom_arabe') }}
            {{ Form::text('prenom_arabe', $elefe->prenom_arabe, ['class' => 'form-control' . ($errors->has('prenom_arabe') ? ' is-invalid' : ''), 'placeholder' => 'Prenom Arabe']) }}
            {!! $errors->first('prenom_arabe', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date_naissance') }}
            {{ Form::text('date_naissance', $elefe->date_naissance, ['class' => 'form-control' . ($errors->has('date_naissance') ? ' is-invalid' : ''), 'placeholder' => 'Date Naissance']) }}
            {!! $errors->first('date_naissance', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lieu_naissance') }}
            {{ Form::text('lieu_naissance', $elefe->lieu_naissance, ['class' => 'form-control' . ($errors->has('lieu_naissance') ? ' is-invalid' : ''), 'placeholder' => 'Lieu Naissance']) }}
            {!! $errors->first('lieu_naissance', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sex') }}
            {{ Form::text('sex', $elefe->sex, ['class' => 'form-control' . ($errors->has('sex') ? ' is-invalid' : ''), 'placeholder' => 'Sex']) }}
            {!! $errors->first('sex', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('photo') }}
            {{ Form::text('photo', $elefe->photo, ['class' => 'form-control' . ($errors->has('photo') ? ' is-invalid' : ''), 'placeholder' => 'Photo']) }}
            {!! $errors->first('photo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CNE') }}
            {{ Form::text('CNE', $elefe->CNE, ['class' => 'form-control' . ($errors->has('CNE') ? ' is-invalid' : ''), 'placeholder' => 'Cne']) }}
            {!! $errors->first('CNE', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('classe_id') }}
            {{ Form::text('classe_id', $elefe->classe_id, ['class' => 'form-control' . ($errors->has('classe_id') ? ' is-invalid' : ''), 'placeholder' => 'Classe Id']) }}
            {!! $errors->first('classe_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $elefe->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>