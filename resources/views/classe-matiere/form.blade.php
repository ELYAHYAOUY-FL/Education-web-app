<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('classe_id') }}
            {{ Form::text('classe_id', $classeMatiere->classe_id, ['class' => 'form-control' . ($errors->has('classe_id') ? ' is-invalid' : ''), 'placeholder' => 'Classe Id']) }}
            {!! $errors->first('classe_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('matiere_id') }}
            {{ Form::text('matiere_id', $classeMatiere->matiere_id, ['class' => 'form-control' . ($errors->has('matiere_id') ? ' is-invalid' : ''), 'placeholder' => 'Matiere Id']) }}
            {!! $errors->first('matiere_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>