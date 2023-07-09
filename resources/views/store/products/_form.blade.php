<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::banner for store-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="required card-title">
                    <h2>صورة المنتج</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <x-elements.logo-image-input name="image" />
            </div>
            <!--end::Card body-->
        </div>
        <!--end::banner for store-->
        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>تفاصيل المنتج</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-5">
                    <label for="user_id" class="required form-label">تصنيف المنتج</label>
                    <select name="user_id" dir="rtl"
                        class="form-select form-select-solid @error('user_id')
                        is-invalid
                        @enderror"
                        data-control="select2" data-placeholder="اضافة قسم">
                        <option></option>
                        @foreach (App\Models\Admin\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <!--begin::Label-->
                <label class="form-label d-block">كلمات البحث</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input id="kt_ecommerce_add_product_tags" name="tag" class="form-control mb-2" value="" />
                <!--end::Input-->
                <!--end::Input group-->
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
                    <span class="card-label fw-bold fs-3 mb-1"> إضافة منتج</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label for="name" class="required form-label">اسم المنتج</label>
                    <input type="text" name="name" id="name"
                        class="form-control form-control-solid @error('name')
                            is-invalid
                            @enderror"
                        placeholder="ادخل اسم للمتجر" value="{{ old('name') }}" />
                </div>
                <div class="mb-5">
                     <label for="description" class="required form-label">وصف المنتج</label>

                    <div id="kt_docs_quill_basic" name="description"
                        class="form-control form-control-solid @error('description')
                        is-invalid
                        @enderror" >
                    </div>
                </div>
            </div>
            <!--begin::Body-->
        </div>
        <!--begin::Variations-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>خصائص المنتج </h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                    <!--begin::Label-->
                    <label class="form-label">اضافة متغير</label>
                    <!--end::Label-->
                    <!--begin::Repeater-->
                    <div id="kt_ecommerce_add_product_options">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="kt_ecommerce_add_product_options"
                                class="d-flex flex-column gap-3">
                                <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                    <!--begin::Select2-->
                                    <div class="w-100 w-md-200px">
                                        <select class="form-select" name="product_option"
                                            data-placeholder="Select a variation"
                                            data-kt-ecommerce-catalog-add-product="product_option">
                                            <option></option>
                                            <option value="color">اللون</option>
                                            <option value="size">الحجم</option>
                                            <option value="material">المادة</option>
                                            <option value="style">الشكل</option>
                                        </select>
                                    </div>
                                    <!--end::Select2-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mw-100 w-200px"
                                        name="product_option_value" placeholder="المتغير" />
                                    <!--end::Input-->
                                    <button type="button" data-repeater-delete=""
                                        class="btn btn-sm btn-icon btn-light-danger">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12"
                                                    height="2" rx="1"
                                                    transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                <rect x="8.46447" y="7.05029" width="12" height="2"
                                                    rx="1" transform="rotate(45 8.46447 7.05029)"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11" y="18" width="12"
                                            height="2" rx="1" transform="rotate(-90 11 18)"
                                            fill="currentColor" />
                                        <rect x="6" y="11" width="12" height="2"
                                            rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->اضافة متغير آخر
                            </button>
                        </div>
                        <!--end::Form group-->
                    </div>
                    <!--end::Repeater-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Variations-->

        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1"> تفاصيل المنتج</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="d-flex justify-content-between gap-7 gap-lg-10 w-100 me-lg-10">
                    <div class="mb-5">
                        <label for="name" class="required form-label">هل المنتج متوفر</label>
                        <div class="form-check form-switch form-check-custom form-check-success form-check-solid ">
                            <input class="form-check-input" name="is_available" type="checkbox" value="1"
                                checked id="is_available" />
                            <label class="form-check-label" for="is_available">
                                متوفر
                            </label>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="status" data-hide-search="true" class="required form-label">حالة المنتج</label>
                        <select name="status" dir="rtl"
                            class="form-select form-select-solid @error('status')
                                    is-invalid
                                @enderror"
                            data-control="select2" data-hide-search="true" data-placeholder="اختر خيار">
                            <option></option>
                            <option value="published" @selected(request('status') === 'published')>تم النشر</option>
                            <option value="draft" @selected(request('status') === 'draft')>مسودة</option>
                            <option value="archived" @selected(request('status') === 'archive')>مؤرشف</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="quantity" class="required form-label">الكمية</label>
                        <input type="number" name="quantity" id="quantity"
                            class="form-control form-control-solid @error('quantity')
                                    is-invalid
                                @enderror"
                            placeholder="الكمية" value="{{ old('quantity') }}" />
                    </div>
                    <div class="mb-5">
                        <label for="price" class="required form-label">السعر</label>
                        <input type="text" name="price" id="price"
                            class="form-control form-control-solid @error('price')
                                    is-invalid
                                @enderror"
                            placeholder="السعر" value="{{ old('price') }}" />
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
            <a href="{{ route('dashboard.products.index') }}" id="kt_ecommerce_add_product_cancel"
                class="btn btn-light me-5">رجوع</a>
            <!--end::Button-->
        </div>
    </div>
</div>
