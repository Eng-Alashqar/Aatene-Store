<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة اعلانات المنتجات" back_url="admin.product-advertisements.index" previews="قائمة اعلانات المنتجات"
                                current="إضافة اعلان المنتج" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.product-advertisements.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
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
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة إعلان للمنتج</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="row card-body py-3">
                                    <div class="mb-5">
                                        <x-form.lable lable="اختار المنتج" />
                                        <select name="product_id" dir="rtl" data-control="select2"
                                                @class(['form-select','form-select-solid ',   'is-invalid' => $errors->has('product_id'),]) data-placeholder="اختار المنتج">
                                            <option></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="تاريخ بدء الاعلان" type="date"  name="start_at" id="start_datepicker" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="تاريخ انتهاء الاعلان" type="date" name="end_at" id="end_datepicker" />
                                    </div>

                                    @if($price)
                                        <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                                            <x-form.input-with-lable readonly lable="سعر الاعلان لليوم/شيكل" value="{{$price->amount}}" name="price" id="price"  />
                                        </div>

                                        <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                                            <x-form.input-with-lable readonly lable="سعر الإعلان الإجمالي/شيكل" id="total_price"  name="" />
                                        </div>
                                    @else
                                        <x-form.input-with-lable readonly lable="سعر الاعلان لليوم" value="لم يتم اضافة سعر الاعلان" name=""  />
                                    @endif



                                    {{--                                    <div class="mb-5">--}}
                                    {{--                                        <x-form.lable lable="حالة الاعلان" />--}}

                                    {{--                                        <select data-control="select2" name="status" @class([--}}
                                    {{--                                            'form-select',--}}
                                    {{--                                            'form-select-solid ',--}}
                                    {{--                                            'is-invalid' => $errors->has('status'),--}}
                                    {{--                                        ]) data-placeholder="اختر حالة هذا الاعلان">--}}

                                    {{--                                            <option value="Active" @selected(old('status') == 'Active')>اعلان فعال</option>--}}
                                    {{--                                            <option value="InActive" @selected(old('status') == 'InActive')> اعلان غير فعال</option>--}}
                                    {{--                                        </select>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    @if($price)
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    @endif
                                    <a href="{{ route('admin.product-advertisements.index') }}"
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
        <script>
            // حساب السعر الإجمالي عند تغيير التواريخ
            $('input[name="start_at"], input[name="end_at"]').change(function () {
                //  تواريخ البداية والانتهاء من الحقول
                var startDate = new Date($('input[name="start_at"]').val());
                var endDate = new Date($('input[name="end_at"]').val());

                if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                    //  سعر الإعلان لليوم الواحد
                    var pricePerDay = parseFloat($('#price').val());

                    // حساب الفارق بين التواريخ بالأيام
                    var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                    var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                    // حساب السعر الإجمالي
                    var totalPrice = daysDiff * pricePerDay;

                    //  بعرض السعر الإجمالي في الحقل
                    $('#total_price').val(totalPrice);
                } else {
                    // إذا لم يتم إدخال تواريخ صحيحة، عرض رسالة خطأ
                    $('#total_price').val('تواريخ غير صحيحة');
                }
            });
        </script>

    @endpush
</x-admin.master>
