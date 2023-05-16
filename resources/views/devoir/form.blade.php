<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('date_limite') }}
            {{ Form::text('date_limite', $devoir->date_limite, ['class' => 'form-control' . ($errors->has('date_limite') ? ' is-invalid' : ''), 'placeholder' => 'Date Limite']) }}
            {!! $errors->first('date_limite', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $devoir->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fichier') }}
            {{ Form::text('fichier', $devoir->fichier, ['class' => 'form-control' . ($errors->has('fichier') ? ' is-invalid' : ''), 'placeholder' => 'Fichier']) }}
            {!! $errors->first('fichier', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('matiere_id') }}
            {{ Form::text('matiere_id', $devoir->matiere_id, ['class' => 'form-control' . ($errors->has('matiere_id') ? ' is-invalid' : ''), 'placeholder' => 'Matiere Id']) }}
            {!! $errors->first('matiere_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>