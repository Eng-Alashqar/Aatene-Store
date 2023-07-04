<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة الأقسام" back_url="admin.categories.index" previews="قائمة الأقسام"
                current="إضافة قسم" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.categories.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::photo for store-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="required card-title">
                                        <h2>ارفع صورة للقسم</h2>
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
                            <!--end::photo for store-->

                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة قسم</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="اسم القسم" name="name"
                                            placeholder="ادخل اسم للقسم" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.textarea-with-lable lable="وصف القسم" name="description"
                                            placeholder="ادخل وصف للقسم" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.lable lable="  القسم الاب" />
                                        <select name="parent_id" dir="rtl" data-control="select2"
                                            @class([
                                                'form-select',
                                                'form-select-solid ',
                                                'is-invalid' => $errors->has('parent_id'),
                                            ]) data-placeholder="اختر الاب لهذا القسم">
                                            <option></option>
                                            @foreach ($categories as $parent)
                                                <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>
                                                    {{ $parent->name }}</option>
                                                <optgroup label="{{ $parent->name }}">

                                                    @foreach ($parent->children as $category)
                                                        <option value="{{ $category->id }}"
                                                            @selected(old('parent_id') == $category->id)>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="mb-5">
                                        <x-form.lable lable="حالة القسم" />

                                        <select data-control="select2" name="status" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('status'),
                                        ])
                                            placeholder="اختر حالة هذا القسم">
                                            <option value="active" @selected(old('status') == 'active')>قسم نشط</option>
                                            <option value="archive" @selected(old('status') == 'archive')> قسم مؤرشف
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('admin.categories.index') }}"
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
