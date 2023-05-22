<div class="form-group row">
    <label>{{ $label ?? $name }}</label>
    <input type="{{ $type ?? "text" }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{$class ?? ""}}@error($name) is-invalid @enderror" 
        value="{{ $value ?? old($name) ?? "" }}" @isset($readonly) readonly @endisset >
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>