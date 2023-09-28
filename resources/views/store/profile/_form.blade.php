<div class="d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::banner for store-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="required card-title">
                    <h2>تعديل صورة</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <x-elements.logo-image-input name="avatar"/>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::banner for store-->

    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="card card-flush py-4 ">
            <!--begin::Header-->
            <div class="card-header border-0 ">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">تعديل الملف الشخصي</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label for="first_name" class="required form-label">الاسم الاول</label>
                    <input type="text" name="first_name" id="first_name"
                           class="form-control form-control-solid @error('first_name')
                            is-invalid
                            @enderror"
                           value="{{ old('first_name', $user->profile->first_name) }}"/>
                </div>
                <div class="mb-5">
                    <label for="last_name" class="required form-label">الاسم الاخير</label>
                    <input type="text" name="last_name" id="last_name"
                           class="form-control form-control-solid @error('last_name')
                            is-invalid
                            @enderror"
                           value="{{ old('last_name', $user->profile->last_name) }}"/>
                </div>
                <div class="mb-5">
                    <label for="name" class="required form-label">تاريخ الميلاد</label>
                    <input type="date" name="birthday" id="birthday"
                           class="form-control form-control-solid @error('birthday')
                            is-invalid
                            @enderror"
                           value="{{ old('birthday', $user->profile->birthday) }}"/>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="mb-5">
                            <label for="name" class="required form-label">المدينة</label>
                            <input type="text" name="city" id="city"
                                   class="form-control form-control-solid @error('city')
                            is-invalid
                            @enderror"
                                   value="{{ old('city', $user->profile->city) }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="mb-5">
                            <label for="name" class="required form-label">عنوان الشارع</label>
                            <input type="text" name="street_address" id="street_address"
                                   class="form-control form-control-solid @error('street_address')
                            is-invalid
                            @enderror"

                                   value="{{ old('street_address', $user->profile->street_address) }}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="mb-5">
                            <label for="state" class="required form-label">العاصمة</label>
                            <input type="text" name="state" id="state"
                                   class="form-control form-control-solid @error('state')
                            is-invalid
                            @enderror"
                                   value="{{ old('state', $user->profile->state) }}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="mb-5">
                            <label for="country" class="required form-label">الدولة</label>
                            <input type="text" name="country" id="country"
                                   class="form-control form-control-solid @error('country')
                            is-invalid
                            @enderror"

                                   value="{{ old('country', $user->profile->country) }}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="mb-5">
                            <label for="country" class="required form-label">الجنس</label>

                            <select class="form-select @error('country')
                            is-invalid
                            @enderror" name="gender">
                                <option value="male" @selected($user->profile?->gender == 'male')> ذكر</option>
                                <option value="female" @selected($user->profile?->gender == 'female')> انثى</option>

                            </select>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="d-flex justify-content-start gap-6">
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label"> حفظ التغيرات </span>
                <span class="indicator-progress">انتظر قليلا...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('dashboard.profile.index') }}" id="kt_ecommerce_add_product_cancel"
               class="btn btn-light me-5">رجوع</a>
            <!--end::Button-->
        </div>
    </div>
</div>

