 <!--begin::Input group-->
 <div class="my-5 fv-row">
    <x-form.input-with-lable type="number" lable=" الكمية" name="quantity"
        placeholder="ادخل  الكمية" />
</div>
<!--end::Input group-->

<div class="mb-5">
    <label for="name" class="required form-label">هل المنتج متوفر</label>
    <div class="form-check form-switch form-check-custom form-check-success form-check-solid ">
        <input class="form-check-input" name="is_available" type="checkbox" value="1"
            @checked(old('is_available')) id="is_available_checkbox" />
        <input type="hidden" name="is_available" id="is_available_input" value="0">
        <label class="form-check-label" for="is_available">
            متوفر
        </label>
    </div>
</div>

<div class="mb-5">
    <label for="name" class="required form-label">هل المنتج مميز</label>
    <div class="form-check form-switch form-check-custom form-check-success form-check-solid ">
        <input class="form-check-input" name="featured" type="checkbox" value="1"
            @checked(old('featured')) id="featured_checkbox" />
        <input type="hidden" name="featured" id="featured_input" value="0">

        <label class="form-check-label" for="is_available">
            مميز
        </label>
    </div>
</div>


@push('scripts')


<script>
    const checkbox = document.getElementById('is_available_checkbox');
    const isAvailable = document.getElementById('is_available_input');
    // checkbox.value = 1;
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            isAvailable.value = '1';
        } else {
            isAvailable.value = '0';
        }
    });
</script>
<script>
    const featured_checkbox = document.getElementById('featured_checkbox');
    const featured = document.getElementById('featured_input');
    // checkbox.value = 1;
    featured_checkbox.addEventListener('change', function() {
        if (this.checked) {
            featured.value = '1';
        } else {
            featured.value = '0';
        }
    });
</script>

@endpush
