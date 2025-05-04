@extends('layouts.app')

@section('title', __('Faculty Settings'))

@section('content')


<style>
        .nav-tabs {
            border-bottom: none;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

    </style>

        <div class="card p-4">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><span class="mdi mdi-cog-outline me-2"></span>{{ __('Edit Faculty') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('departments.teachers', $department->id) }}"><span class="mdi mdi-key-outline me-2"></span>{{ __('Teachers') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('departments.levels', $department->id) }}"><span class="mdi mdi-key-outline me-2"></span>{{ __('Levels') }}</a></li>
            </ul>

            <form id="editProfileForm" action="{{ route('settings.account.update') }}" method="POST">
                @csrf
                <div class="row mb-4">

                    <div class="form-group form-group-floating col-md-6 {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" placeholder="{{ __('Name') }}" >
                    </div>

                    <div class="form-group form-group-floating col-md-6 {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="code" class="form-label">{{ __('Code') }}</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $department->code }}" placeholder="{{ __('Code') }}" >
                    </div>

                    <div class="form-group form-group-floating col-md-6 {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="name_ar" class="form-label">{{ __('Name (Arabic)') }}</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ $department->name_ar }}" placeholder="{{ __('Name (Arabic)') }}" >
                    </div>

                    <div class="form-group form-group-floating col-md-6 {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $department->email }}" placeholder="{{ __('Email') }}" >
                    </div>

                    <div class="form-group form-group-floating col-md-6 {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description" placeholder="{{ __('Description') }}" rows="3">{{ $department->description }}</textarea>
                    </div>

                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                </div>
            </form>
        </div>

<script>

$(document).ready(function () {
    $('#editProfileForm').submit(function (event) {
        event.preventDefault();
        $('#loading').show();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#loading').hide();
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                $('#loading').hide();
                const response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
            }
        });
    });
});
</script>

@endsection
