@if ($type=='hidden')
    <input type="{{ $type ?? "text" }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{$class ?? ""}}@error($name) is-invalid @enderror" 
        value="{{ $value ?? old($name) ?? "" }}" @isset($readonly) readonly @endisset >    
@else
<div class="form-group row">
    <label class="col-sm-3 col-form-label">{{ $label ?? $name }}</label>
    <div class="col-sm-9">
        @if ($type=='datesaja')
        <div class="form-group">
            <div class="input-group date" id="{{ $name }}" data-target-input="nearest">
                <input type="text" id="val{{ $name }}" name="val{{ $name }}" class="form-control datetimepicker-input" data-target="#{{ $name }}"/>
                <div class="input-group-append" data-target="#{{ $name }}" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        
        @else
        <input type="{{ $type ?? "text" }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{$class ?? ""}}@error($name) is-invalid @enderror" 
            value="{{ $value ?? old($name) ?? "" }}" @isset($readonly) readonly @endisset >
        @endif
    </div>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
@endif