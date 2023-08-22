<div class="card card-flush py-4">
    <div class="card-body">
        <!--begin::Repeater-->
        <div id="options">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="options">
                    <div data-repeater-item>
                        <div class="form-group row mb-5">
                            <div class="col-md-10">
                                <label class="form-label">النوع:</label>
                                <select class="form-select" name="attribute" data-placeholder="اختر النوع"
                                    data-kt-repeater="select2">
                                    <option></option>
                                    <option value="color">اللون</option>
                                    <option value="size">الحجم</option>
                                    <option value="material">المادة</option>
                                    <option value="style">التنسيق</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:;" data-repeater-delete
                                    class="btn btn-sm btn-flex btn-light-danger mt-3 mt-md-9">
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span><span class="path5"></span></i>
                                    حذف
                                </a>
                            </div>
                            <div class="col-md-10">
                                <div class="inner-repeater">
                                    <div data-repeater-list="options_value" class="mb-5">
                                        <div data-repeater-item>
                                            <div class="row d-flex">
                                                <div class="col-2">
                                                    <label class="form-label">القيمة:</label>
                                                    <div class="input-group pb-3">
                                                        <input class="form-control" placeholder="ادخل القيمة" />

                                                    </div>
                                                </div>
                                                <div class="col-2 mx-1">
                                                    <label class="form-label">السعر:</label>
                                                    <div class="input-group pb-3">
                                                        <input class="form-control" placeholder="ادخل السعر" />

                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label">صورة:</label>
                                                    <div class="input-group pb-3">
                                                        <input type="file" class="form-control" name="oprion_file" />
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <label class="form-label"></label>

                                                    <div class="input-group pt-3">
                                                        <button
                                                            class="border border-secondary btn btn-icon btn-flex btn-light-danger"
                                                            data-repeater-delete type="button">
                                                            <i class="ki-duotone ki-trash fs-4"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span
                                                                    class="path5"></span></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-flex btn-light-primary" data-repeater-create
                                            type="button">
                                            <i class="ki-duotone ki-plus fs-5"></i>
                                            اضافة قيمة
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group text-center">
                <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                    <i class="ki-duotone ki-plus fs-3"></i>
                    اضافة خاصية جديدة
                </a>
            </div>
            <!--end::Form group-->
        </div>
        <!--end::Repeater-->
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

<script>

    $('#options').repeater({
        initEmpty: true,
        defaultValues: {
            'text-input': 'foo'
        },
        repeaters: [{
            selector: '.inner-repeater',
            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        }],

        show: function() {
            $(this).find('[data-kt-repeater="select2"]').select2();

            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function() {
            // Init select2
            $('[data-kt-repeater="select2"]').select2();
            // Init Tagify
        }
    });
</script>
@endpush
