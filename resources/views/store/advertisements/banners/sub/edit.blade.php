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
<x-store.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة اعلانات البنر الفرعي" back_url="dashboard.sub-banners.index" previews="قائمة اعلانات البنر الفرعي"
                                current="تعديل اعلان البنر الفرعي" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('dashboard.sub-banners.update',$sub_banner_ads->id) }}"
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
                                        <span class="card-label fw-bold fs-3 mb-1"> تعديل إعلان للبنر الفرعي </span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="row card-body py-3">
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="المتجر" name="" disabled  value="{{auth()->user()->store->name}}"   />
                                        <x-form.input-with-lable  type="hidden" value="{{auth()->user()->store_id}}"  name="store_id"  />
                                    </div>

                                    {{--                                    <input type="hidden" name="images[]" id="files-uploaded">--}}
                                    {{--                                    @include('admin.advertisements.banners.main.form_elements._images')--}}
                                    <div  class="col-md-6 ">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <span class="required">{{'الصور'}}</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="الصور"></i>
                                        </label>
                                        <br>
                                        <!--end::Label-->
                                        <div class="dz-default dz-message" >قم بإسقاط الصور هنا أو إضغط للرفع</div>
                                        <input id="files" type="file" class="dropzone" name="images[]" multiple="multiple" accept="image/jpeg, image/png, image/jpg,image/gif">
                                        <span class="dz-default dz-message fw-semibold text-gray-400">يسمح لك التحميل حتى 5 صور</span>

                                        <output id="result">
                                            @foreach(json_decode($sub_banner_ads->image) as $key => $image)
                                                <img src="{{url('assets/media/ads/main-banners/'.$image)}}" style="height: 100px" width="100"
                                                     class="lozad rounded mw-100" alt=""/>
                                            @endforeach
                                        </output>
                                    </div>
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="تاريخ بدء الاعلان" type="date" value="{{$sub_banner_ads->start_at}}"  name="start_at" id="start_datepicker" />
                                    </div>
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="تاريخ انتهاء الاعلان" type="date" value="{{$sub_banner_ads->end_at}}" name="end_at" id="end_datepicker" />
                                    </div>

                                    <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                                        <x-form.input-with-lable readonly lable="سعر الاعلان لليوم/شيكل" value="{{$sub_banner_ads->price}}" name="price" id="price"  />
                                    </div>

                                    <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                                        <x-form.input-with-lable readonly lable="سعر الإعلان الإجمالي/شيكل" value="{{$sub_banner_ads->total}}" id="total_price"  name="" />
                                    </div>



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
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('dashboard.sub-banners.index') }}"
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
            document.querySelector("#files").addEventListener("change", (e) => { //CHANGE EVENT FOR UPLOADING PHOTOS
                if (window.File && window.FileReader && window.FileList && window.Blob) { //CHECK IF FILE API IS SUPPORTED
                    const files = e.target.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
                    const output = document.querySelector("#result");
                    output.innerHTML = "";
                    for (let i = 0; i < files.length; i++) { // LOOP THROUGH THE FILE LIST OBJECT
                        if (!files[i].type.match("image")) continue; // ONLY PHOTOS (SKIP CURRENT ITERATION IF NOT A PHOTO)
                        const picReader = new FileReader(); // RETRIEVE DATA URI
                        picReader.addEventListener("load", function (event) { // LOAD EVENT FOR DISPLAYING PHOTOS
                            const picFile = event.target;
                            const div = document.createElement("div");
                            div.innerHTML = `<img class="thumbnail" src="${picFile.result}" title="${picFile.name}"/>`;
                            output.appendChild(div);
                        });
                        picReader.readAsDataURL(files[i]); //READ THE IMAGE
                    }
                } else {
                    alert("Your browser does not support File API");
                }
            });
        </script>
    @endpush
</x-store.master>
