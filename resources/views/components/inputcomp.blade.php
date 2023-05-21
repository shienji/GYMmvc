<div class="form-group">
    <label>{{ $label ?? $name }}</label>
    <input type="{{ $type ?? "text" }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" value="{{ $value ?? old($name) ?? "" }}">
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>