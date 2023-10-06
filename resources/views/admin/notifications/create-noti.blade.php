<x-admin.master>
    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="قائمة الاشعارات" back_url="admin.categories.index" previews="قائمة الاشعارات"
                                current="دفع الاشعارات" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    {{-- <x-error-show-list /> --}}
                    <form class="form d-flex flex-column flex-lg-row" id="my-form" action="{{ route('admin.store.noti') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::photo for store-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class=" card-title">
                                        <h2>ارفع صورة (اختياري)</h2>
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
                                        <span class="card-label fw-bold fs-3 mb-1">دفع الاشعارات</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="عنوان الاشعار" name="title"
                                                                 placeholder="ادخل العنوان" />
                                    </div>

                                    <div class="mb-5">
                                        <x-form.textarea-with-lable lable="محتوى الاشعار" name="content" line="3" placeholder="ادخل محتوى الاشعار" />
                                    </div>

                                    <div class="mb-5">
                                        <x-form.lable lable="نوع الاشعار" />

                                        <select data-control="select2" name="type" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('type'),
                                        ])
                                        placeholder="اختر نوع الاشعار">
                                            <option value="email" @selected(old('type') == 'email')>Email</option>
                                            <option value="app" @selected(old('type') == 'app')>Application</option>
                                            <option value="sms" @selected(old('type') == 'sms')>SMS</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <x-form.input-with-lable lable="launch_at" name="launch_at" value="2023-09-14 19:26:28"
                                                                placeholder="2023-09-14 19:26:28" />
                                    </div>

                                    <div class="mb-5">
                                        <x-form.lable lable="ارسال للعميل" />

                                        <select data-control="select2" id="users" onchange="selecting('users')" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('type'),
                                        ])
                                        placeholder="اختر نوع الاشعار">
                                            <option disabled selected value="#">اختار العميل :</option>

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <p id="users-select"> تم اختيار :  </p>
                                        <button class="badge badge-circle badge-light text-danger border-transparent" onclick="disSelect('users')" type="button">x</button>
                                    </div>



                                    <div class="mb-5">
                                        <x-form.lable lable="ارسال لمتابعين المتجر" />

                                        <select data-control="select2" id="followers" onchange="selecting('followers')" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('type'),
                                        ])
                                        placeholder="اختر نوع الاشعار">.
                                            <option disabled selected value="#">اختار من متابعين :</option>
                                        @foreach($stores as $store)
                                                <option id="f-{{$store->id}}" value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                        </select>
                                        <p id="followers-select"> تم اختيار :  </p>
                                        <button class="badge badge-circle badge-light text-danger border-transparent" onclick="disSelect('followers')"  type="button">x</button>
                                    </div>


                                    <div class="mb-5">
                                        <x-form.lable lable="ارسال للتاجر " />

                                        <select data-control="select2" id="sellers" onchange="selecting('sellers')" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('type'),
                                        ])
                                        placeholder="اختر نوع الاشعار">
                                            <option disabled selected value="#">اختار التاجر  :</option>
                                        @foreach($sellers as $seller)
                                                <option value="{{$seller->id}}">{{$seller->name}}</option>
                                            @endforeach
                                        </select>
                                        <p id="sellers-select"> تم اختيار :  </p>
                                        <button class="badge badge-circle badge-light text-danger border-transparent" onclick="disSelect('sellers')" type="button">x</button>

                                    </div>


                                </div>


                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
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
    @section('scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        {{-- <script>
            @if (session()->has('notification'))
                toastr.success("{{ session('notification') }}");
            @endif
        </script> --}}

        <script>

            function selecting(type) {

                console.log(type);

                var selectElement = document.getElementById(type);

                var selectedIndex = selectElement.selectedIndex;

                var selectedOption = selectElement.options[selectedIndex];

                var selectedValue = selectedOption.value;
                var selectedText = selectedOption.text;

                console.log("Selected Value: " + selectedValue);
                console.log("Selected Text: " + selectedText);


                var hiddenInput = document.createElement("input");

                hiddenInput.setAttribute("type", "hidden");

                hiddenInput.setAttribute("name", `${type}[]`);

                hiddenInput.setAttribute("value", `${selectedValue}`);


                var form = document.getElementById("my-form");
                form.appendChild(hiddenInput);


                var selected = document.getElementById(`${type}-select`);
                selected.textContent = selected.innerText + " " + selectedText + " ,"



                        }

            function disSelect(type) {
                var elements = document.getElementsByName(`${type}[]`);

                for (var i = elements.length - 1; i >= 0; i--) {
                    var element = elements[i];
                    element.parentNode.removeChild(element);
                }
                var selected = document.getElementById(`${type}-select`);
                selected.textContent = "تم اختيار : "
            }

        </script>

    @endsection


</x-admin.master>
