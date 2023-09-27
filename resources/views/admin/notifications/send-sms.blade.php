<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.home" previews="الرئيسية - ارسال الاشعارات" current="{{$current}}" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">

                    @if(session('message'))
                        <div class="text-danger"> {{session('message')}} </div>
                    @endif
                    <form class="form d-flex flex-column flex-lg-row" action="{{route('admin.send.sms')}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1"> كتابة الرسالة</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">

                                    <div class="mb-5">
                                        <label for="" class="form-lable required">وصف الرسالة</label>
                                        <textarea rows="3" id="name" name="message" class="form-control form-control-solid" placeholder="ادخل نص الرسالة"></textarea>
                                    </div>


                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button type="submit" class="btn btn-primary  btn-sm w-150px">ارسال</button>
                                    <button type="reset" class="btn btn-danger  btn-sm  w-150px">مسح</button>
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

</x-admin.master>

