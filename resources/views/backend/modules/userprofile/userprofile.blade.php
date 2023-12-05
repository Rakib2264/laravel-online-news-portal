@extends('backend.layouts.master')
@section('page_title', 'Profile')
@section('page_sub_title', 'Profile')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Profile</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('userprofile.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            @if ($profile)
                                <input type="number" class="form-control" value="{{ $profile->phone }}" name="phone"
                                    id="phone" placeholder="Enter phone number">
                            @else
                                <input type="number" class="form-control" name="phone" id="phone"
                                    placeholder="Enter phone number">
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Select Division</label>
                                <select class="form-select" name="division_id" id="division_id">
                                    @isset($profile->division_id)
                                        <option selected>{{ $profile->division?->name }}</option>
                                    @endisset
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Distric</label>
                                <select class="form-select" name="district_id" id="distric_id" disabled>

                                    @isset($profile->district_id)
                                        <option selected>{{ $profile->districts?->name }}</option>
                                    @endisset
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Thana</label>
                                <select class="form-select" name="thana_id" id="thana_id" disabled>
                                    @isset($profile->thana_id)
                                        <option selected>{{ $profile->thana?->name }}</option>
                                    @endisset
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="gender">Select Gender</label>
                                <div class="d-flex m-1">
                                    <div class="form-check m-1">
                                        <input class="form-check-input" type="radio" value="male" name="gender"
                                            id="male"
                                            {{ isset($profile) && $profile->gender == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check m-1">
                                        <input class="form-check-input" type="radio" value="female" name="gender"
                                            id="female"
                                            {{ isset($profile) && $profile->gender == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check m-1">
                                        <input class="form-check-input" type="radio" value="other" name="gender"
                                            id="other"
                                            {{ isset($profile) && $profile->gender == 'other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="other">
                                            Other
                                        </label>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <button class="btn btn-sm btn-info btn-add" type="submit">Save Or Update Profile</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Upload Profile Photo</h4>
            </div>
            <div class="card-body">
                <label for="image"></label>
                <input type="file" name="" id="">
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.1/axios.min.js"></script>

    <script>
        const getDistricts = (division_id) => {
            axios.get(`${window.location.origin}/get-district/${division_id}`)
                .then(res => {
                    let districts = res.data
                    let elements = jQuery('#distric_id')
                    let thana_element = jQuery('#thana_id').empty().append(`<option>Select Distict</option>`).attr(
                        'disabled', 'disabled')
                    elements.removeAttr('disabled')
                    elements.empty()
                    elements.append(`<option>Select Distict</option>`)
                    districts.map((district, index) => {
                        elements.append(`<option value="${district.id}">${district.name}</option>`)
                    });
                })
        }

        jQuery(document).on('change', "#division_id", function() {
            getDistricts($(this).val());
        })

        const getThanas = (district_id) => {
            axios.get(`${window.location.origin}/get-thana/${district_id}`)
                .then(res => {
                    let thanas = res.data
                    let elements = jQuery('#thana_id')
                    elements.removeAttr('disabled')
                    elements.empty()
                    elements.append(`<option>Select Thana</option>`)
                    thanas.map((thana, index) => {
                        elements.append(`<option value="${thana.id}">${thana.name}</option>`)
                    });
                })
        }


        jQuery(document).on('change', "#distric_id", function() {
            getThanas($(this).val());
        })
    </script>
@endpush
