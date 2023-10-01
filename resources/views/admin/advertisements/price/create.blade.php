<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="اسعار الاعلانات" back_url="admin.regions.index" previews="قائمة الاسعار"
                                current="إضافة سعر" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.prices.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة سعر</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="سعر الاعلان/بالشيكل" name="amount" placeholder="ادخل سعر الاعلان بالشيكل" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.lable lable="اختار نوع الاعلان" />
                                        <select name="ad_type" dir="rtl" data-control="select2"
                                                @class(['form-select','form-select-solid ',   'is-invalid' => $errors->has('ad_type'),]) data-placeholder="اختار نوع الاعلان">
                                            <option></option>
                                            <option value="store" @selected(old('store') == 'store')>اعلان المتجر</option>
                                            <option value="product" @selected(old('product') == 'product')>اعلان المنتج</option>
                                            <option value="products_list" @selected(old('products_list') == 'products_list')>اعلان قائمة منتجات</option>
                                            <option value="main_banner" @selected(old('main_banner') == 'main_banner')>اعلان البنر الرئيسي</option>
                                            <option value="sub_banner" @selected(old('sub_banner') == 'sub_banner')>اعلان البنر الفرعي</option>
                                        </select>
                                    </div>

                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('admin.prices.index') }}"
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
    @endpush
</x-admin.master>
