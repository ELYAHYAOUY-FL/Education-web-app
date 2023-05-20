<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nom') }}
            {{ Form::text('nom', $class->nom, ['class' => 'form-control' . ($errors->has('nom') ? ' is-invalid' : ''), 'placeholder' => 'Nom']) }}
            {!! $errors->first('nom', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('capacity') }}
            {{ Form::text('capacity', $class->capacity, ['class' => 'form-control' . ($errors->has('capacity') ? ' is-invalid' : ''), 'placeholder' => 'Capacity']) }}
            {!! $errors->first('capacity', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('niveau_scolaire_id') }}
            {{ Form::text('niveau_scolaire_id', $class->niveau_scolaire_id, ['class' => 'form-control' . ($errors->has('niveau_scolaire_id') ? ' is-invalid' : ''), 'placeholder' => 'Niveau Scolaire Id']) }}
            {!! $errors->first('niveau_scolaire_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('emploi_id') }}
            {{ Form::text('emploi_id', $class->emploi_id, ['class' => 'form-control' . ($errors->has('emploi_id') ? ' is-invalid' : ''), 'placeholder' => 'Emploi Id']) }}
            {!! $errors->first('emploi_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>