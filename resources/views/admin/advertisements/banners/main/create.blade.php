@push('styles')
    <style>
        #result{
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px 0;
        }

        .thumbnail {
            height: 92px;
            border: 4px #ffb500 solid;
            border-radius: 10px;
        }
    </style>
@endpush
<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة اعلانات البنر الرئيسي" back_url="admin.main-banners.index" previews="قائمة اعلانات البنر الرئيسي"
                                current="إضافة اعلان البنر الرئيسي" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('admin.main-banners.store') }}"
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
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة إعلان للبنر الرئيسي</span>
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
                                                <option value="{{ $store->id }}" @selected(old('store_id') == $store->id)>{{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

{{--                                    <input type="hidden" name="images[]" id="files-uploaded">--}}
{{--                                    @include('admin.advertisements.banners.main.form_elements._images')--}}
                                    <div  class="col-md-6 ">
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">صور الاعلان</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="الصور"></i>
                                        </label>
                                        <div class="fv-row mb-2">
                                            <!--begin::Dropzone-->
                                            <div class="dropzone">
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
                                                        <input  type="file" multiple name="images[]" id="imageInput">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                                                            قم باسقاط الملفات هنا او اضغط للتحميل.
                                                        </h3>
                                                        <span class="fs-7 fw-semibold text-gray-400">يسمح لك التحميل حتى 5 صور</span>
                                                    </div>
                                                    <!--end::Info-->
                                                    <output id="result"></output>
                                                </div>
                                            </div>
                                            <!--end::Dropzone-->

                                        </div>
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
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    @if($price)
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    @endif
                                    <a href="{{ route('admin.main-banners.index') }}"
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
        <script>
            // انتظر حتى يتم تحميل المستند بالكامل
            document.addEventListener("DOMContentLoaded", function () {
                // حدد عنصر الإدخال لرفع الصور
                var imageInput = document.getElementById("imageInput");

                // أضف مستمع حدث التغيير إلى عنصر الإدخال
                imageInput.addEventListener("change", function () {
                    // قم بفحص عدد الملفات المختارة
                    var selectedFiles = this.files;
                    if (selectedFiles.length > 5) {
                        alert("يسمح فقط بتحميل 5 صور فقط.");
                        // إعادة تفريغ الحقل للحفاظ على 5 صور فقط
                        this.value = "";
                    }
                });
            });
        </script>


    @endpush
</x-admin.master>
