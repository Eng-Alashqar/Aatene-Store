<div class="card card-flush py-4">
    <div class="card-body">
        <div class="row d-flex">
            @foreach ( $regions   as $region )
            <div class="col-8">
                <label class="form-label">المنطقة:</label>
                <div class="input-group pb-3">
                    <input class="form-control" readonly placeholder="ادخل القيمة" value=" {{ $region->name }}" name="region"/>
                    <input class="form-control" readonly placeholder="ادخل القيمة" value=" {{ $region->id }}" type="hidden" name="region_id_{{ $region->id }}"/>

                </div>
            </div>
            <div class="col-3 mx-1">
                <label class="form-label">السعر:</label>
                <div class="input-group pb-3">
                    <input class="form-control" placeholder="ادخل السعر"  value="{{ old("region_price_$region->id",0) }}" name="region_price_{{ $region->id }}"/>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
