<div class="mb-5">
    <label for="status" data-hide-search="true" class="required form-label">حالة
        المنتج</label>
    <select name="status" dir="rtl"
        class="form-select form-select-solid @error('status')
            is-invalid
        @enderror"
        data-control="select2" data-hide-search="true" data-placeholder="اختر خيار">
        <option></option>
        <option value="active" @selected(old('status',$product->status) === 'active')>فعال</option>
        <option value="draft" @selected(old('status',$product->status) === 'draft')>مسودة</option>
        <option value="archived" @selected(old('status',$product->status) === 'archived')>مؤرشف</option>
    </select>
</div>
