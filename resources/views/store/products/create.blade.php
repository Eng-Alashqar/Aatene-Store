<x-store.master>

    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="ادارة المنتجات" back_url="dashboard.index" previews="قائمة المنتجات"
                current="إضافة منتج" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data"
                        id="my-form">
                        @csrf
                        @include('store.products._form', ['button_label' => 'اضافة المنتج'])
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
        <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>

        <script>
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['blockquote'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'direction': 'rtl'
                }], // text direction

                [{
                    'size': ['small', false, 'large', 'huge']
                }], // custom dropdown
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],

            ];

            var quill = new Quill('#kt_docs_quill_basic', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            quill.format('align', 'right');
            quill.format('direction', 'rtl');
        </script>

        <script>
            @if (session()->has('notification'))
                toastr.success("{{ session('notification') }}");
            @endif
        </script>
        <script>
            var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                url: "{{ route('dashboard.products.store') }}", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 10,
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                autoProcessQueue: false
            });
        </script>
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            $('#Variants').repeater({
                initEmpty: true,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                    // Re-init select2
                    $(this).find('[data-kt-repeater="select2"]').select2();



                    // Re-init tagify
                    new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    // Init select2
                    $('[data-kt-repeater="select2"]').select2();

                    // Init Tagify
                    new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
                }
            });
        </script>
    @endpush

</x-store.master>
