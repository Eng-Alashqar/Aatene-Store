<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::banner for store-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="required card-title">
                    <h2>اضافة صورة</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <x-elements.logo-image-input name="image"/>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::banner for store-->
        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mt-5 d-flex justify-content-around align-items-center">
                    <label for="name" class="required form-label fs-4">حالة النشر</label>
                    <div
                        class="d-flex justify-content-between form-check form-switch form-check-custom form-check-success form-check-solid ">
                        <input class="form-check-input" name="is_published" type="checkbox" value="1"
                               @checked(old('is_published',$blog->is_published))
                               id="is_published_checkbox"/>
                        <input type="hidden" name="is_published" id="is_published_input" value="0">

                        <label class="form-check-label fs-5" for="is_published">
                            نشر
                        </label>
                    </div>
                </div>


            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">تدوين</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label for="name" class="required form-label">العنوان</label>
                    <input type="text" name="title" id="title"
                           class="form-control form-control-solid @error('title')
                            is-invalid
                            @enderror"
                           placeholder="اكتب عنوان مناسب" value="{{ old('title', $blog->title) }}"/>
                </div>
                <div class="mb-5">
                    <label for="content" class="required form-label">النص</label>

                    <textarea id="kt_docs_quill_basic" name="content" class="form-control form-control-solid">{{ old('content', $blog->content) }}</textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start gap-6">
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label"> حفظ التغيرات </span>
                <span class="indicator-progress">انتظر قليلا...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('dashboard.blogs.index') }}" id="kt_ecommerce_add_product_cancel"
               class="btn btn-light me-5">رجوع</a>
            <!--end::Button-->
        </div>
    </div>
</div>
@push('scripts')
    <script>
        const checkbox = document.getElementById('is_published_checkbox');
        const isPublished = document.getElementById('is_published_input');
        // checkbox.value = 1;
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                isPublished.value = '1';
            } else {
                isPublished.value = '0';
            }
        });
    </script>

@endpush
