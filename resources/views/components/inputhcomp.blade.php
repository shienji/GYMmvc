@if ($type=='hidden')
    <input type="{{ $type ?? "text" }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{$class ?? ""}}@error($name) is-invalid @enderror" 
        value="{{ $value ?? old($name) ?? "" }}" @isset($readonly) readonly @endisset >    
@else
<div class="form-group row">
    <label class="col-sm-3 col-form-label">{{ $label ?? $name }}</label>
    <div class="col-sm-9">
    <input type="{{ $type ?? "text" }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{$class ?? ""}}@error($name) is-invalid @enderror" 
        value="{{ $value ?? old($name) ?? "" }}" @isset($readonly) readonly @endisset >
    </div>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
@endif