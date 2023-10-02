<x-store.master>

    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar lable="المدونات" back_url="dashboard.blogs.index" previews="المدونات"
                                current="تدوين"/>
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form action="{{ route('dashboard.blogs.store') }}" method="POST" enctype="multipart/form-data"
                          id="form-create">
                        @csrf
                        @include('store.blogs._form', ['button_label' => 'حفظ المدونة'])
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->

</x-store.master>
@push('scripts')
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
        let formSubmitHandler = document.getElementById('form-create');
        let textarea = document.getElementById('content');
        formSubmitHandler.addEventListener("submit", (event) => {
            event.preventDefault();
            textarea.value = quill.root.innerHTML;
            formSubmitHandler.submit();
        });
    </script>
@endpush
