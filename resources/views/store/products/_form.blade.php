<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-400px mb-7 me-lg-10">
       @include('store.products.form_elements._image')
        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>تفاصيل المنتج</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                    @include('store.products.form_elements._categories')
                    @include('store.products.form_elements._status')
                    @include('store.products.form_elements._qty&featured&avialable')
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
        <!--begin::Pricing-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>السعر</h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">

                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <x-form.input-with-lable lable=" السعر" name="price" placeholder="سعر المنتج" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <x-form.input-with-lable lable=" سعر المقارنة" name="compare_price" placeholder="سعر المقارنة" />
                </div>
                <!--end::Card header-->
            </div>
        </div>
        <!--end::Pricing-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::Tab content-->
        <div>
            <!--begin::Tab pane-->
            <div id="kt_ecommerce_add_product_general">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    @include('store.products.form_elements._main-info')
                    @include('store.products.form_elements._media')
                    @include('store.products.form_elements._options')
                    @include('store.products.form_elements._shipping')
                    <!--begin::Buttons-->
                    <div class="d-flex justify-content-start gap-6">
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                            <span class="indicator-label">{{ $button_label ?? 'حفظ التغيرات' }} </span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <a href="{{ route('dashboard.products.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">رجوع</a>
                        <!--end::Button-->
                    </div>
                    <!--end::Buttons-->
                </div>

            </div>
            <!--end::Tab pane-->

        </div>
        <!--end::Tab content-->

    </div>
</div>
