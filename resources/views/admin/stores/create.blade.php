<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة المتاجر" back_url="admin.stores.index" previews="قائمة المتاجر"
                current="إضافة متجر" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.stores.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::logo for store-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="required card-title">
                                        <h2>ارفع شعار للمتجر</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <x-elements.logo-image-input name="logo" />

                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::logo for store-->
                            <!--begin::banner for store-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="required card-title">
                                        <h2>ارفع لافتة للمتجر</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <x-elements.logo-image-input name="cover" />
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
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة متجر</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        <label for="name" class="required form-label">اسم المتجر</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control form-control-solid @error('name')
                                        is-invalid
                                        @enderror"
                                            placeholder="ادخل اسم للمتجر" value="{{ old('name') }}" />
                                    </div>
                                    <div class="mb-5">
                                        <label for="description" class="required form-label">وصف المتجر</label>
                                        <textarea rows="1" id="description" name="description"
                                            class="form-control form-control-solid @error('description')
                                        is-invalid
                                        @enderror"
                                            placeholder="ادخل وصف للمتجر"> </textarea>
                                    </div>
                                    <div class="mb-5">
                                        <label for="user_id" class="required form-label"> صاحب المتجر </label>
                                        <select name="user_id"
                                            class="form-select form-select-solid @error('user_id')
                                        is-invalid
                                        @enderror"
                                            data-control="select2" data-placeholder="اختر صاحب هذا  المتجر">
                                            <option></option>
                                            <option value="1">قىاثفس 1</option>
                                            <option value="2">فاشثفسفا 2</option>
                                            <option value="2">ثشاشث 2</option>
                                            <option value="2">فاف 2</option>
                                        </select>

                                    </div>
                                    <div class="mb-5">
                                        <label for="name" class="required form-label">المدن المدعوة </label>
                                        <select
                                            class="form-select form-select-solid @error('regions')
                                        is-invalid
                                        @enderror"
                                            data-control="select2" data-close-on-select="false"
                                            data-placeholder="اختر الدول التي يدعمها متجرك" multiple="multiple"
                                            name="regions[]">
                                            <option></option>
                                            <option value="1">قىاثفس 1</option>
                                            <option value="2">فاشثفسفا 2</option>
                                            <option value="2">ثشاشث 2</option>
                                            <option value="2">فاف 2</option>
                                            <option value="2">Option 2</option>
                                        </select>

                                    </div>
                                    <div class="mb-5">
                                        <label for="name" class="required form-label">حالة المتجر </label>
                                        <div
                                            class="form-check form-switch form-check-custom form-check-success form-check-solid ">
                                            <input class="form-check-input" name="status" type="checkbox"
                                                value="active" checked id="status" />
                                            <label class="form-check-label" for="status">
                                                تفعيل المتجر
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a class="btn btn-danger  btn-sm  w-150px">عودة</a>
                                </div>
                                <!--begin::Footer-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
    @push('scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        <script>
            
        </script>
    @endpush
</x-admin.master>
