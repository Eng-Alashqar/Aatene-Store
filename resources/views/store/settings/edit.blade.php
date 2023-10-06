<x-store.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة المتاجر" back_url="dashboard.home" previews="الرئيسية"
                                current="تعديل بيانات المتجر"/>
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row"
                          action="{{ route('dashboard.store-settings.update') }}"
                          method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::logo for store-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="required card-title">
                                        <h2>تعديل شعار المتجر</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <x-elements.logo-image-input name="logo"/>

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
                                        <h2>تعديل لافتة المتجر</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <x-elements.logo-image-input name="cover"/>
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
                                        <span class="card-label fw-bold fs-3 mb-1"> تعديل اعدادات المتجر</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="اسم المتجر" name="name"
                                                                 placeholder="ادخل اسم للمتجر" :value="$store->name"/>
                                    </div>
                                    <div class="mb-5">
                                        <x-form.textarea-with-lable lable="وصف المتجر" name="description"
                                                                    placeholder="ادخل وصف للمتجر"
                                                                    :value="$store->description"/>
                                    </div>
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="عنوان المتجر" name="location"
                                                                 placeholder="ادخل عنوان للمتجر"
                                                                 :value="$store->location"/>
                                    </div>
                                    <div class="mb-5">
                                        <x-form.lable lable="المدن المدعوة"/>
                                        <select name="regions[]" dir="rtl"
                                                data-control="select2" @class([
                                                'form-select',
                                                'form-select-solid ',
                                                'is-invalid' => $errors->has('regions'),
                                            ]) data-
                                                placeholder="اختر الدول التي يدعمها متجرك" data-close-on-select="false"
                                                multiple="multiple" data-search="true">
                                            <option></option>

                                            @foreach ($regions as $region)

                                                <option value="{{ $region->id }}"
                                                        @if (in_array($region->id, $store->regions->pluck('id','id')->toArray())) selected @endif>
                                                    {{ $region->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <x-form.lable lable="حالة المتجر"/>

                                        <select data-control="select2" name="status" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('status'),
                                        ])
                                        placeholder="اختر حالة هذا المتجر">
                                            <option value="active" @selected(old('status') == 'active')>متجر نشط
                                            </option>
                                            <option value="inactive" @selected(old('status') == 'inactive') >متجر في اجازة
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('dashboard.home') }}"
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

</x-store.master>
