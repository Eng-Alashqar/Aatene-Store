<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::banner for store-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="required card-title">
                    <h2>صورة شعار الشركة</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <x-elements.logo-image-input name="company_logo"/>
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
                    <h2>معلومات الشركة</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->

                <div class="mb-5">
                    <label for="company" class="required form-label">اسم الشركة</label>
                    <input type="text" name="company" id="company"
                           class="form-control form-control-solid @error('company')
                                    is-invalid
                                @enderror"
                           placeholder="اسم الشركة" value="{{ $job->company }}"/>
                </div>
                <div class="mb-5">
                    <label for="location" class="required form-label">مكان الشركة</label>
                    <input type="text" name="location" id="location"
                           class="form-control form-control-solid @error('location')
                                    is-invalid
                                @enderror"
                           placeholder="مكان الشركة" value="{{ $job->location }}"/>
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
                    <span class="card-label fw-bold fs-3 mb-1">الوظيفة</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label for="title" class="required form-label">العنوان الوظيفي</label>
                    <input type="text" name="title" id="title"
                           class="form-control form-control-solid @error('title')
                            is-invalid
                            @enderror"
                           placeholder="العنوان الوظيفي" value="{{ old('title', $job->title) }}"/>
                </div>
                <div class="mb-5">
                    <label for="description" class="form-label required">وصف الوظيفة</label>

                    <textarea id="kt_docs_quill_basic" name="description"
                              class="form-control form-control-solid @error('description') is-invalid @enderror">{{ old('description', $job->description) }}</textarea>
                </div>
            </div>
            <!--begin::Body-->
        </div>

        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1"> تفاصيل العمل</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="d-flex justify-content-between gap-7 gap-lg-10 w-100 me-lg-10">
                    <div class="mb-5">
                        <label for="place" data-hide-search="true" class="required form-label">طبيعة العمل</label>
                        <select name="place" dir="rtl"
                                class="form-select form-select-solid @error('place')
                                    is-invalid
                                @enderror"
                                data-control="select2" data-hide-search="true" data-placeholder="اختر خيار">
                            <option></option>
                            <option value="office" @selected(old('place', $job->place) === 'office')>العمل من مقر
                                الشركة
                            </option>
                            <option value="remotly" @selected(old('place', $job->place) === 'remotly')>عمل عن بعد
                            </option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="type" data-hide-search="true" class="required form-label">نوع العمل</label>
                        <select name="type" dir="rtl"
                                class="form-select form-select-solid @error('type')
                                    is-invalid
                                @enderror"
                                data-control="select2" data-hide-search="true" data-placeholder="اختر خيار">
                            <option></option>
                            <option value="full-time" @selected(old('type', $job->type) === 'full-time')>دوام كامل
                            </option>
                            <option value="part-time" @selected(old('type', $job->type) === 'part-time')>دوام جزئي
                            </option>
                            <option value="piece" @selected(old('type', $job->type) === 'piece')>بالقطعة</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="salary" class="required form-label">الراتب</label>
                        <input type="text" name="salary" id="salary"
                               class="form-control form-control-solid @error('salary')
                                    is-invalid
                                @enderror"
                               placeholder="الراتب" value="{{ old('salary', $job->salary) }}"/>
                    </div>
                    <div class="mb-5">
                        <label for="deadline" class="required form-label">الموعد النهائي</label>
                        <input type="date" name="deadline" id="deadline"
                               class="form-control form-control-solid @error('deadline')
                                    is-invalid
                                @enderror"
                               placeholder="الموعد النهائي" value="{{ old('deadline', $job->deadline) }}"/>
                    </div>
                </div>
            </div>
            <!--begin::Body-->
        </div>

        <div class="d-flex justify-content-start gap-6">
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label"> حفظ التغيرات  </span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('dashboard.jobs.index') }}" id="kt_ecommerce_add_product_cancel"
               class="btn btn-light me-5">رجوع</a>
            <!--end::Button-->
        </div>
    </div>
</div>
