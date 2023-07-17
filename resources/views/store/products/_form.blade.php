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
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->children as $child)
                                    <option value="{{ $child->id }}" @selected(old('category_id', $product->category_id) === $child->id)>{{ $child->name }}
                                    </option>
                                @endforeach
                            </optgroup>
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
                        placeholder="ادخل اسم للمتجر" value="{{ old('name', $product->name) }}" />
                </div>
                <div class="mb-5">
                    <label for="description" class="required form-label">وصف المنتج</label>

                    <textarea id="kt_docs_quill_basic" name="description" class="form-control form-control-solid">
                        {{ old('description', $product->description) }}
                    </textarea>
                </div>
            </div>
            <!--begin::Body-->
        </div>
        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1"> إضافة الوسائط</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Dropzone-->
                    <div class="dropzone" id="kt_dropzonejs_example_1">
                        <!--begin::Message-->
                        <div class="dz-message needsclick">
                            <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <!--begin::Info-->
                            <div class="ms-4">
                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">قم بإسقاط الملفات هنا أو انقر للتحميل.
                                </h3>
                                <span class="fs-7 fw-semibold text-gray-400">تحميل ما يصل إلى 10 ملفات</span>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Dropzone-->
                </div>
                <!--end::Input group-->
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

                <!--begin::Repeater-->
                <div id="Variants">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="Variants">
                            <div data-repeater-item>
                                <div class="form-group row mb-5">
                                    <div class="col-md-3">
                                        <label class="form-label">اشر على الخيارات:</label>
                                        <select class="form-select" data-kt-repeater="select2"
                                            data-placeholder="اشر على الخيارات" name="attribute">
                               <option></option>
                                            <option value="Size">الحجم</option>
                                            <option value="Color">اللون</option>
                                            <option value="material">مادة</option>
                                            <option value="style">نمط</option>
                                            <option value="type">نوع</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">القيمة:</label>
                                        <input class="form-control" data-kt-repeater="tagify" value=""
                                            name="value" />
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-flex btn-sm btn-light-danger mt-3 mt-md-9">
                                            <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                            حذف
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group">
                        <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            إضافة
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->


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
                            <option value="updated" @selected(old('status', $product->status) === 'updated')>محدَّث</option>
                            <option value="new" @selected(old('status', $product->status) === 'new')>جديد</option>
                            <option value="expired" @selected(old('status', $product->status) === 'expired')>منتهي</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="quantity" class="required form-label">الكمية</label>
                        <input type="number" name="quantity" id="quantity"
                            class="form-control form-control-solid @error('quantity')
                                    is-invalid
                                @enderror"
                            placeholder="الكمية" value="{{ old('quantity', $product->quantity) }}" />
                    </div>
                    <div class="mb-5">
                        <label for="price" class="required form-label">السعر</label>
                        <input type="text" name="price" id="price"
                            class="form-control form-control-solid @error('price')
                                    is-invalid
                                @enderror"
                            placeholder="السعر" value="{{ old('price', $product->price) }}" />
                    </div>
                </div>
            </div>
            <!--begin::Body-->
        </div>

        <div class="d-flex justify-content-start gap-6">
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label">{{ $button_label ?? 'حفظ التغيرات' }} </span>
                <span class="indicator-progress">انتظر لوسمحت...
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
