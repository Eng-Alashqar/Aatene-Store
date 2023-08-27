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
        {{-- @include('store.products.form_elements._pricing') --}}
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::Tab pane-->
        <div id="kt_ecommerce_add_product_general">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                @include('store.products.form_elements._main-info')
                @include('store.products.form_elements._media')
                @include('store.products.form_elements._options')
                @include('store.products.form_elements._shipping')
                @include('store.products.form_elements._buttons')
            </div>

        </div>
        <!--end::Tab pane-->
    </div>
</div>
