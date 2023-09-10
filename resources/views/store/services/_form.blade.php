<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::banner for store-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="required card-title">
                    <h2>صورة غلاف</h2>
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
                    <span class="card-label fw-bold fs-3 mb-1"> إضافة خدمة</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label for="name" class="required form-label">اسم الخدمة</label>
                    <input type="text" name="name" id="name"
                           class="form-control form-control-solid @error('name')
                            is-invalid
                            @enderror"
                           placeholder="ادخل اسم للمتجر" value="{{ old('name', $service->name) }}"/>
                </div>
                <div class="mb-5">
                    <label for="description" class="required form-label">وصف الخدمة</label>
                    <textarea name="description"
                              class="form-control form-control-solid">{{ old('description', $service->description) }}</textarea>
                </div>
            </div>
            <!--begin::Body-->
        </div>

        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1"> تفاصيل الخدمة</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="d-flex justify-content-between gap-7 gap-lg-10 w-100 me-lg-10">
                    <div class="mb-5">
                        <label for="name" class="required form-label">الحالة</label>
                        <div class="form-check form-switch form-check-custom form-check-success form-check-solid ">
                            <input class="form-check-input" name="active" type="checkbox" value="1"
                                   checked id="active"/>
                            <label class="form-check-label" for="active">
                                متوفر
                            </label>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="duration" class="required form-label">المدة الزمنية</label>
                        <input type="number" name="duration" id="duration"
                               class="form-control form-control-solid @error('duration')
                                    is-invalid
                                @enderror"
                               placeholder="المدة الزمنية" value="{{ old('duration', $service->duration) }}"/>
                    </div>
                    <div class="mb-5">
                        <label for="price" class="required form-label">السعر</label>
                        <input type="text" name="price" id="price"
                               class="form-control form-control-solid @error('price')
                                    is-invalid
                                @enderror"
                               placeholder="السعر" value="{{ old('price', $service->price) }}"/>
                    </div>
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
            <a href="{{ route('dashboard.services.index') }}" id="kt_ecommerce_add_product_cancel"
               class="btn btn-light me-5">رجوع</a>
            <!--end::Button-->
        </div>
    </div>
</div>
