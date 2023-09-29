<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar  back_url="admin.users.index" previews="قائمة المستخدمين"
                current="إضافة مستخدم" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.users.update',$user->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1"> تعديل مستخدم</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable=" كلمة السر " name="password"
                                            placeholder="ادخل كلمة السر " autocomplete="off" type="password" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable=" تاكيد كلمة السر " name="password_confirmation"
                                            placeholder="ادخل تاكيد كلمة السر " autocomplete="off" type="password" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.lable lable="حالة المستخدم" />

                                        <select data-control="select2" name="status" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('status'),
                                        ])
                                            placeholder="اختر حالة هذا المستخدم">
                                            <option value="active" @selected(old('status') == 'active')>مستخدم نشط</option>
                                            <option value="blocked" @selected(old('status') == 'blocked')>مستخدم محظور</option>
                                        </select>
                                    </div>


                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-danger  btn-sm  w-150px">عودة</a>
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
        {{-- <script>
            @if (session()->has('notification'))
                toastr.success("{{ session('notification') }}");
            @endif
        </script> --}}
    @endpush
</x-admin.master>
