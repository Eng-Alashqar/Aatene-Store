<div class="d-flex flex-column flex-lg-row">

    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
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
                    <label class="required form-label">تصنيف المنتج</label>
                    <select name="category_id" dir="rtl" class="form-select" data-control="select2"
                        data-placeholder="اضافة قسم">
                        <option></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) === $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <div class="mb-5">
                    <label for="status" data-hide-search="true" class="required form-label">حالة
                        المنتج</label>
                    <select name="status" dir="rtl"
                        class="form-select form-select-solid @error('status')
                            is-invalid
                        @enderror"
                        data-control="select2" data-hide-search="true" data-placeholder="اختر خيار">
                        <option></option>
                        <option value="updated" @selected(old('status', $product->status) === 'updated')>محدَّث</option>
                        <option value="new" @selected(old('status', $product->status) === 'new')>جديد</option>
                        <option value="expired" @selected(old('status', $product->status) === 'expired')>منتهي</option>
                    </select>
                </div>
                <!--begin::Input group-->
                <!--begin::Label-->
                <label class="form-label d-block">كلمات البحث</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input id="kt_ecommerce_add_product_tags" name="tag" class="form-control mb-2" value="" />
                <!--end::Input-->
                <!--end::Input group-->
                <div class="mb-5">
                    <label for="name" class="required form-label">هل المنتج متوفر</label>
                    <div class="form-check form-switch form-check-custom form-check-success form-check-solid ">
                        <input class="form-check-input" name="is_available" type="checkbox" value="1" checked
                            id="is_available" />
                        <label class="form-check-label" for="is_available">
                            متوفر
                        </label>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
        <!--begin::Inventory-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>المخزون</h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <x-form.input-with-lable lable="sku" name="sku" placeholder="SKU عدد" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <x-form.input-with-lable type="number" lable=" الكمية" name="quantity"
                        placeholder="ادخل  الكمية" />
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Inventory-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::Tab content-->
        <div>
            <!--begin::Tab pane-->
            <div id="kt_ecommerce_add_product_general">
                <div class="d-flex flex-column gap-7 gap-lg-10">
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
                                <x-form.input-with-lable lable="اسم المنتج" name="name"
                                    placeholder="ادخل اسم المنتج" />
                            </div>
                            <div class="mb-5">
                                <label for="description" class="required form-label">وصف المنتج</label>
                                <div id="kt_docs_quill_basic" name="description"
                                    class="form-control form-control-solid">
                                    {{ old('description', $product->description) }}</div>
                                <textarea name="description" id="description" style="display: none"></textarea>
                            </div>
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Media-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>الوسائط</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="fv-row mb-2">
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_dropzonejs_example_1">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-file-up text-primary fs-3x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                                                قم باسقاط الملفات هنا او اضغط للتحميل.
                                            </h3>
                                            <span class="fs-7 fw-semibold text-gray-400">يسمح لك التحميل حتى 10
                                                ملفات</span>
                                        </div>
                                        <!--end::Info-->


                                    </div>
                                </div>
                                <!--end::Dropzone-->

                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Media-->
                    <!--begin::Pricing-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>السعر</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-6">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <x-form.input-with-lable lable=" السعر" name="price"
                                            placeholder="سعر المنتج" />
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-6">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <x-form.input-with-lable lable=" سعر المقارنة" name="compare_price"
                                            placeholder="سعر المقارنة" />
                                    </div>
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>
                    </div>
                    <!--end::Pricing-->
                    <!--begin::Variations-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>خصائص المنتج</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                <!--begin::Label-->
                                <label class="form-label">قم باضافة خصائص لهذا المنتج</label>
                                <!--end::Label-->
                                <!--begin::Repeater-->
                                <div id="kt_ecommerce_add_product_options">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_ecommerce_add_product_options"
                                            class="d-flex flex-column gap-3">
                                            <div data-repeater-item=""
                                                class="form-group d-flex flex-wrap align-items-center gap-5">
                                                <!--begin::Select2-->
                                                <div class="w-100 w-md-200px">
                                                    <select class="form-select" name="product_option"
                                                        data-placeholder="اختر النوع"
                                                        data-kt-ecommerce-catalog-add-product="product_option">
                                                        <option></option>
                                                        <option value="color">اللون</option>
                                                        <option value="size">الحجم</option>
                                                        <option value="material">المادة</option>
                                                        <option value="style">التنسيق</option>
                                                    </select>
                                                </div>
                                                <!--end::Select2-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control mw-100 w-200px"
                                                    name="product_option_value" placeholder="القيمة" />
                                                <!--begin::Input-->
                                                <input type="number" class="form-control mw-100 w-200px"
                                                    name="product_option_price" placeholder="السعر" min="0" />
                                                <!--end::Input-->
                                                <button type="button" data-repeater-delete=""
                                                    class="btn btn-sm btn-icon btn-light-danger">
                                                    <i class="ki-duotone ki-cross fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <button type="button" data-repeater-create=""
                                            class="btn btn-sm btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-2"></i>اضافة نوع اخر
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
                    <!--begin::Buttons-->
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
                    <!--end::Buttons-->
                </div>

            </div>
            <!--end::Tab pane-->

        </div>
        <!--end::Tab content-->

    </div>
</div>
