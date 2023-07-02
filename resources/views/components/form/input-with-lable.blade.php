@props(['type' => 'text','value' => '', 'placeholder' => '', 'lable' => false, 'name' ,'required'=>true,'id' => 'name','value'=>''])

    <x-form.lable lable={{$lable}} />
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        {{ $attributes->class(['form-control', 'form-control-solid ', 'is-invalid' => $errors->has($name)]) }}
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $attributes }} />
