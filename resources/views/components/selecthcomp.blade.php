<div class="form-group row">
    <label class="col-sm-3 col-form-label">{{ $label ?? $name }}</label>
    <div class="col-sm-9">
        <select class="custom-select form-control-border border-width-2" 
        id="{{ $name }}" name="{{ $name }}" @isset($readonly) readonly @endisset >
            <option value=""></option>
            @isset($data)
                @php
                    // $datas = json_decode($data,true);
                    // foreach ($datas as $k => $v) {
                    //     echo $k." >".$v;
                    // }
                @endphp
                
                {{-- @foreach ($data as $i)
                    <option value="{{$i->role_nama}}">{{$i->role_nama}}</option>
                @endforeach --}}
            @endisset
        </select>
    </div>

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>