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
    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
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
            let textarea = document.getElementById('description');
            formSubmitHandler.addEventListener("submit", (event) => {
                event.preventDefault();
                textarea.value = quill.root.innerHTML;
                formSubmitHandler.submit();
            });
        </script>
        <script>
            var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                url: "{{ route('dashboard.product_images') }}",
                paramName: "files",
                maxFiles: 5,
                maxFilesize: 1,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                removedfile: function(file) {
                    var filesUploaded = [];
                    var existingFiles = localStorage.getItem("filesUploaded");
                    if (existingFiles) {
                        filesUploaded = JSON.parse(existingFiles);
                    }
                    var name = filesUploaded.find(photoObj => photoObj.photo_slug === file.upload.filename);                        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url:"{{ route('dashboard.product_images.delete') }}",
                        data: {
                            filename: name
                        },
                        success: function(response) {
                            console.log(response)
                            var filesUploaded = [];
                            var existingFiles = localStorage.getItem("filesUploaded");
                            if (existingFiles) {
                                filesUploaded = JSON.parse(existingFiles);
                            }
                            var newArray = filesUploaded.filter((element) => element.photo != response.path.photo);
                            localStorage.setItem("filesUploaded", JSON.stringify(newArray));
                            document.querySelector('#files-uploaded').value = localStorage.getItem("filesUploaded");
                            console.log(document.querySelector('#files-uploaded').value,newArray);
                        },
                        error: function(e) {
                            console.log(e);
                        }

                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;

                },
                success: function(file, response) {
                    var filesUploaded = [];
                    var existingFiles = localStorage.getItem("filesUploaded");
                    if (existingFiles) {
                        filesUploaded = JSON.parse(existingFiles);
                    }
                    let array =  JSON.stringify(document.querySelector('#files-uploaded').value);
                    // if (array.length >=0 && ){
                    //     array.forEach((file)=>{
                    //         this.removedfile(file)
                    //     });
                    // }
                    filesUploaded.push(response.data);
                    localStorage.setItem("filesUploaded", JSON.stringify(filesUploaded));
                    document.querySelector('#files-uploaded').value = localStorage.getItem("filesUploaded");
                    console.log(document.querySelector('#files-uploaded').value);
                }
            });
            localStorage.removeItem("filesUploaded");

        </script>
        <script>
            $('#options').repeater({
                initEmpty:true,
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
            new Tagify(document.querySelector('#tags'));
        </script>
    @endpush

</x-store.master>
