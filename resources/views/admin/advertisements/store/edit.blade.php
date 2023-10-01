<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة اعلانات المتاجر" back_url="admin.advertisements.index" previews="قائمة اعلانات المتاجر"
                                current="تعديل الاعلان" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.advertisements.update',$store_advertisement->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1"> تعديل إعلان المتجر</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="row card-body py-3">
                                    <div class="mb-5">
                                        <x-form.lable lable="اختار المتجر" />
                                        <select name="store_id" dir="rtl" data-control="select2"
                                                @class(['form-select','form-select-solid ',   'is-invalid' => $errors->has('store_id'),]) data-placeholder="اختار المتجر">
                                            <option></option>
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->id }}" @selected($store_advertisement->store_id == $store->id)>{{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="تاريخ بدء الاعلان" type="date" value="{{$store_advertisement->start_at}}" name="start_at"  />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="تاريخ انتهاء الاعلان" value="{{$store_advertisement->end_at}}" type="date" name="end_at"  />
                                    </div>
                                    <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                                        <x-form.input-with-lable readonly lable="سعر الاعلان لليوم/شيكل" value="{{$store_advertisement->price}}" name="price" id="price"  />
                                    </div>

                                    <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                                        <x-form.input-with-lable readonly lable="سعر الإعلان الإجمالي/شيكل"  value="{{$store_advertisement->total}}"  name="total" />
                                    </div>
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('admin.advertisements.index') }}"
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
