<!--begin::Media-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title required">
            <h2>الوسائط</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="fv-row mb-2">
            <!--begin::Dropzone-->
            <div class="dropzone" id="kt_dropzonejs_example_1">
                <!--begin::Message-->
                <div class="dz-message needsclick">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-file-up text-primary fs-3x">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <!--end::Icon-->
                    <!--begin::Info-->
                    <div class="ms-4">
                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                            قم باسقاط الملفات هنا او اضغط للتحميل.
                        </h3>
                        <span class="fs-7 fw-semibold text-gray-400">يسمح لك التحميل حتى 10
                            ملفات</span>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Dropzone-->

        </div>
        <!--end::Input group-->

    </div>
    <!--end::Card header-->
</div>
<!--end::Media-->
@push('scripts')
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
            var name = filesUploaded.find(photoObj => photoObj.photo_slug === file.upload.filename);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('dashboard.product_images.delete') }}",
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
                    var newArray = filesUploaded.filter((element) => element.photo != response
                        .path.photo);
                    localStorage.setItem("filesUploaded", JSON.stringify(newArray));
                    document.querySelector('#files-uploaded').value = localStorage.getItem(
                        "filesUploaded");
                    console.log(document.querySelector('#files-uploaded').value, newArray);
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
            let array = JSON.stringify(document.querySelector('#files-uploaded').value);
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
@endpush
