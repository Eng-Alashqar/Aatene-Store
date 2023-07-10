<div class="d-flex flex-column flex-lg-row">
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1"> إضافة موضوع</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label for="title" class="required form-label">عنوان الموضوع</label>
                    <input type="text" name="title" id="title"
                        class="form-control form-control-solid @error('title')
                            is-invalid
                            @enderror"
                        placeholder="ادخل اسم للمتجر" value="{{ old('title') }}" />
                </div>
                <div class="mb-5">
                    <label for="content" class="required form-label">الموضوع</label>

                    <div id="kt_docs_quill_basic" name="content" class="form-control form-control-solid">
                    </div>
                </div>
            </div>
            <!--begin::Body-->
        </div>


        <div class="d-flex justify-content-start gap-6">
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label">{{ $button_label ?? 'حفظ التغيرات' }} </span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('dashboard.home') }}" id="kt_ecommerce_add_product_cancel"
                class="btn btn-light me-5">رجوع</a>
            <!--end::Button-->
        </div>
    </div>
</div>
