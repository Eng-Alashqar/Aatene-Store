<x-store.master>

    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة المنتجات" back_url="dashboard.products.index" previews="قائمة المنتجات"
                current="إضافة منتج" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <form action="{{ route('dashboard.products.store') }}" id="form-create" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="files" id="files-uploaded">
                            @include('store.products._form', ['button_label' => 'اضافة المنتج'])
                        </form>

                    </div>
                    <!--end::Main column-->

                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
 

</x-store.master>
