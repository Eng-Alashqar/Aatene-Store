<div class="card card-flush py-4">
    <div class="card-body">
        <!--begin::Repeater-->
        {{--        @dd($options)--}}
        <div id="options">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="options">

                    @forelse ($options ?? [] as $option)
{{--                        @if(array_key_exists('attribute',$option))--}}
                        <div data-repeater-item>
                            <div class="form-group row mb-5">
                                <div class="col-md-10">
                                    <label class="form-label">النوع:</label>
                                    <select class="form-select" name="attribute" data-placeholder="اختر النوع"
                                            data-kt-repeater="select2">
                                        <option></option>
                                        <option value="color" @selected($option['attribute'] == 'color')>اللون</option>
                                        <option value="size" @selected($option['attribute'] == 'size')>الحجم</option>
                                        <option value="material" @selected($option['attribute'] == 'material')>المادة
                                        </option>
                                        <option value="style" @selected($option['attribute'] == 'style')>التنسيق
                                        </option>
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
                                                        <div class="col-2  mt-10">
                                                            <!--begin::Card body-->
                                                            <div class="card">
                                                                <div class="card-body w-5px">
                                                                    <x-elements.logo-image-input-sm
                                                                        name="options_value_photo"/>
                                                                </div>
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <div class="col-2 mt-15">
                                                            <label class="form-label">القيمة:</label>
                                                            <div class="input-group pb-3">
                                                                <input class="form-control" name="options_value_value"
                                                                       placeholder="ادخل القيمة"
                                                                       value="{{ $option['options_value']['options_value_value'] }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 mx-1 mt-15">
                                                            <label class="form-label">السعر:</label>
                                                            <div class="input-group pb-3">
                                                                <input class="form-control" name="options_value_price"
                                                                       placeholder="ادخل السعر"
                                                                       value="{{ $option['options_value']['options_value_price'] }}"/>
                                                            </div>
                                                        </div>

                                                        <div class="col-1 mt-15">
                                                            <label class="form-label">متاح:</label>
                                                            <div
                                                                class="form-check mt-2 form-switch form-check-custom form-check-success form-check-solid ">
                                                                <input class="form-check-input" type="checkbox"
                                                                       onchange="checkboxValueChange(this)"
                                                                       @checked($option['options_value']['options_value_available'])
                                                                       id="featured_checkbox"/>
                                                                <input type="hidden" name="options_value_available"
                                                                       value="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 mt-19">
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
                                                <button class="btn btn-sm btn-flex btn-light-primary"
                                                        data-repeater-create
                                                        type="button">
                                                    <i class="ki-duotone ki-plus fs-5"></i>
                                                    اضافة قيمة
                                                </button>
                                            </div>
                                        </div>

                                    </div>
{{--                                @endif--}}
                            </div>
                        </div>
                    @empty

                    @endforelse
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
        $(document).ready(function () {
            $('#options').repeater({
                initEmpty: "{{ old('options',$options) ? false : true }}",
                defaultValues: {
                    'text-input': 'foo'
                },
                repeaters: [{
                    selector: '.inner-repeater',
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                }],

                show: function () {
                    $(this).find('[data-kt-repeater="select2"]').select2();
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function () {
                    // Init select2
                    $('[data-kt-repeater="select2"]').select2();
                    // Init Tagify
                }
            });

        });
    </script>

    <script>
        function checkboxValueChange(referances) {
            const isAvailable = referances.nextElementSibling;
            console.log(isAvailable.value);
            if (referances.checked) {
                isAvailable.value = '1';
            } else {
                isAvailable.value = '0';
            }
        };
    </script>
@endpush
