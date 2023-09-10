<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::banner for store-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="required card-title">
                    <h2>صورة موضوع</h2>
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

    </div>
    <!--end::Aside column-->
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
                    <textarea  name="content" class="form-control form-control-solid @error('content')
                    is-invalid
                    @enderror">{{ old('content') }}</textarea>
                </div>
            </div>
            <!--begin::Body-->
        </div>


        <div class="d-flex justify-content-start gap-6">
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label">حفظ التغيرات </span>
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
