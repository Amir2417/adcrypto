@forelse ($selected_networks ?? [] as $item)
<div class="row align-items-end {{ $class ?? '' }}">
    <div class="col-xl-6 col-lg-6 form-group">
        <label>{{ __("Network") }}<span>*</span></label>
        @php
            $select2    = $select2 ?? true;
        @endphp
        <select class="form--control  @if($select2 != false) select2-basic @endif  network-select" name="network[]">
            
            @foreach ($networks as $network)
                <option value="{{ $network->id }}" {{ $network->id == $item->network_id ? 'selected' : '' }}>{{ $network->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-xl-5 col-lg-5 form-group">
        <label>{{ __("Fees*") }}</label>
        <div class="input-group">
            <input type="text" class="form--control number-input" name="fees[]" value="{{ $item->fees ?? '' }}">
            <span class="input-group-text selcted-currency">{{ old('code') }}</span>
        </div>
    </div>
    <div class="col-xl-1 col-lg-1 form-group">
        <button type="button" class="custom-btn btn--base btn--danger row-cross-btn w-100"><i class="las la-times"></i></button>
    </div>
</div>
@empty
<div class="row align-items-end {{ $class ?? '' }}">
    <div class="col-xl-6 col-lg-6 form-group">
        <label>{{ __("Network") }}<span>*</span></label>
        @php
            $select2    = $select2 ?? true;
        @endphp
        <select class="form--control  @if($select2 != false) select2-basic @endif  network-select" name="network[]">
            <option disabled selected>{{ __("Select Network") }}</option>
            @foreach ($networks as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-xl-5 col-lg-5 form-group">
        <label>{{ __("Fees*") }}</label>
        <div class="input-group">
            <input type="text" class="form--control number-input" name="fees[]">
            <span class="input-group-text selcted-currency">{{ old('code') }}</span>
        </div>
    </div>
    <div class="col-xl-1 col-lg-1 form-group">
        <button type="button" class="custom-btn btn--base btn--danger row-cross-btn w-100"><i class="las la-times"></i></button>
    </div>
</div>
@endforelse

@push('script')
   
@endpush