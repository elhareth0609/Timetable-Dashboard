@extends('layouts.app')

@section('title', __('Levels'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Levels') }}</h1>

<div class="card p-2" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">
    <div class="container-fluid mt-5">
        <div class="row {{ app()->getLocale() == "ar" ? "me-1" : "ms-1" }} mb-2">
            <input type="text" class="form-control my-w-fit-content m-1" id="dataTables_my_filter" placeholder="{{ __('Search ...') }}" name="search">

            <select class="form-select my-w-fit-content m-1" id="dataTables_my_length" name="length">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <button class="btn btn-icon btn-outline-primary m-1" id="" data-bs-toggle="modal" data-bs-target="#createLevelModal"><span class="mdi mdi-plus-outline"></span></button>

            <div class="dropdown my-w-fit-content px-0">
                <button class="btn btn-icon btn-outline-primary m-1" type="button" data-bs-toggle="dropdown">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
                <ul class="dropdown-menu p-1 {{ app()->getLocale() == "ar" ? "text-end dropdown-menu-end" : "dropdown-menu-start" }}" aria-labelledby="dropdownMenuButton1" id="columns_filter_dropdown">
                </ul>
            </div>
        </div>
        <div class="table-responsive rounded-3 border mb-3">
            <table id="table" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><input class="form-check-input" type="checkbox" id="check-all"></th>
                        <th>{{__("Id")}}</th>
                        <th>{{__("Name")}}</th>
                        <th>{{__("Name (Arabic)")}}</th>
                        <th>{{__("Code")}}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="row align-items-baseline justify-content-end">
            <div class="my-w-fit-content" id="dataTables_my_info"></div>
            <nav class="my-w-fit-content" aria-label="Table navigation"><ul class="pagination" id="dataTables_my_paginate"></ul></nav>
        </div>
    </div>
</div>

<!-- Create Level Modal -->
<div class="modal fade" id="createLevelModal" tabindex="-1" aria-labelledby="createLevelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createLevelForm" action="{{route('level.create')}}" method="POST">
            <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLevelLabel">{{ __('Create Level') }}</h5>
                    <button type="button" class="btn btn-light btn-close {{ app()->isLocale('ar') ? 'ms-0 me-auto' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="code" class="form-label">{{ __('Code') }}</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="{{ __('Code') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="type" class="form-label">{{ __('Type') }}</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="{{ __('Type') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="capacity" class="form-label">{{ __('Capacity') }}</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="{{ __('Capacity') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="building" class="form-label">{{ __('Building') }}</label>
                        <input type="text" class="form-control" id="building" name="building" placeholder="{{ __('Building') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="location" class="form-label">{{ __('Location') }}</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="{{ __('Location') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="has_projector" class="form-label">{{ __('Has Projector') }}</label>
                        <select class="form-select" id="has_projector" name="has_projector" aria-label="Has Projector">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="has_computers" class="form-label">{{ __('Has Computers') }}</label>
                        <select class="form-select" id="has_computers" name="has_computers" aria-label="Has Computers">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Level Modal -->
<div class="modal fade" id="editLevelModal" tabindex="-1" aria-labelledby="editLevelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editLevelForm" method="POST">
            <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLevelLabel">{{ __('Edit Level') }}</h5>
                    <button type="button" class="btn btn-light btn-close {{ app()->isLocale('ar') ? 'ms-0 me-auto' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id" required>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_code" class="form-label">{{ __('Code') }}</label>
                        <input type="text" class="form-control" id="edit_code" name="code" placeholder="{{ __('Code') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="{{ __('Name') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_type" class="form-label">{{ __('Type') }}</label>
                        <select class="form-select" id="edit_type" name="type" aria-label="Type">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Auditorium') }}</option>
                            <option value="2">{{ __('Classlevel') }}</option>
                            <option value="3">{{ __('Laboratory') }}</option>
                        </select>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_capacity" class="form-label">{{ __('Capacity') }}</label>
                        <input type="number" class="form-control" id="edit_capacity" name="capacity" placeholder="{{ __('Capacity') }}" >
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_building" class="form-label">{{ __('Building') }}</label>
                        <select class="form-select" id="edit_building" name="building" aria-label="Building">
                            <option value="">{{ __('Select') }}</option>
                            {{-- @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_location" class="form-label">{{ __('Location') }}</label>
                        <select class="form-select" id="edit_location" name="location" aria-label="location">
                            <option value="">{{ __('Select') }}</option>
                            {{-- @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_has_projector" class="form-label">{{ __('Has Projector') }}</label>
                        <select class="form-select" id="edit_has_projector" name="has_projector" aria-label="Has Projector">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_has_computers" class="form-label">{{ __('Has Computers') }}</label>
                        <select class="form-select" id="edit_has_computers" name="has_computers" aria-label="Has Computers">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
        var table;
        // Start of checkboxes
        var selectedIds = [];
        var ids = [];
        let isCheckAllTrigger = false;
        // End of checkboxes

        function editLevel(id) {
            $('#loading').show();

            $.ajax({
                url: '/level/' + id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                level = data.data;
                console.log(level);
                $('#edit_id').val(level.id);
                $('#edit_code').val(level.code);
                $('#edit_name').val(level.name);
                $('#edit_type').val(level.type);
                $('#edit_capacity').val(level.capacity);
                $('#edit_building').val(level.building);
                $('#edit_location').val(level.location);
                $('#edit_has_projector').val(level.has_projector ? 'Yes' : 'No');
                $('#edit_has_computers').val(level.has_computers ? 'Yes' : 'No');

                $('#loading').hide();
                $('#editLevelModal').modal('show');
                },
                error: function(xhr, textStatus, errorThrown) {
                    const response = JSON.parse(xhr.responseText);
                    $('#loading').hide();
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang)
                    });
                }
            });

        }

        function deleteLevel(id) {
            confirmDelete({
                id: id,
                url: '/level',
                table: table
            });
        }

        function restoreLevel(id) {
            confirmRestore({
                id: id,
                url: '/level',
                table: table
            });
        }

        function viewLevel(id) {
            window.location.href = "{{ route('level.get', '') }}/" + id;
        }

        function showContextMenu(id, x, y) {

            var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
                .append('<li><a onclick="viewLevel(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
                .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
                .append('<li><a onclick="deleteLevel(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');


            contextMenu.css({
                top: y,
                left: x
            });


            $('body').append(contextMenu);

                $(document).on('click', function() {
                $('.context-menu').remove();
                });
        }


    $(document).ready(function() {
            table = $('#table').DataTable({
                pageLength: 100,
                language: {
                    "emptyTable": "<div id='no-data-animation' style='width: 100%; height: 200px;'></div>",
                    "zeroLevels": "<div id='no-data-animation' style='width: 100%; height: 200px;'></div>"
                },
                ajax: {
                    url: "{{ route('levels', ['id' => $department->id]) }}",
                    data: function(d) {
                        d.type = $('#selectType').val();
                    },
                    // Start of checkboxes
                    dataSrc: function(response) {
                        ids = (response.ids || []).map(id => parseInt(id, 10)); // Ensure all IDs are integers
                        selectedIds = [];
                        return response.data;
                    }
                // End of checkboxes
                },
                columns: [
                    // Start of checkboxes
                    {
                        data: 'id',
                        name: '#',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<input type="checkbox" class="form-check-input rounded-2 check-item" value="' + data + '">';
                        }
                    },
                    // End  of checkboxes
                    {data: 'id', name: '{{__("Id")}}',},
                    {data: 'code', name: '{{__("Code")}}'},
                    {data: 'name', name: '{{__("Name")}}'},
                    {data: 'name_ar', name: '{{__("Name (Arabic)")}}'},
                    {data: 'actions', name: '{{__("Actions")}}', orderable: false, searchable: false}
                ],
                order: [[3, 'desc']], // Default order by created_at column

                rowCallback: function(row, data) {
                    $(row).attr('id', 'level_' + data.id);

                    // $(row).on('dblclick', function() {
                    //     window.location.href = "{{ url('level') }}/" + data.id;
                    // });

                    $(row).on('contextmenu', function(e) {
                        e.preventDefault();
                        showContextMenu(data.id, e.pageX, e.pageY);
                    });

                    // Start of checkboxes
                    var $checkbox = $(row).find('.check-item');
                    var levelId = parseInt($checkbox.val());

                    if (selectedIds.includes(levelId)) {
                        $checkbox.prop('checked', true);
                    } else {
                        $checkbox.prop('checked', false);
                    }
                    // End of checkboxes

                },
                drawCallback: function() {
                  // Start of checkboxes
                    $('#check-all').off('click').on('click', function() { // Unbind previous event and bind a new one
                        $('.check-item').prop('checked', this.checked);
                        var totalCheckboxes = ids.length;
                        var checkedCheckboxes = selectedIds.length;

                        if (checkedCheckboxes === 0 || checkedCheckboxes < totalCheckboxes) { // if new all checked or some checked
                            selectedIds = [];
                            selectedIds = ids.slice();
                        } else {
                            selectedIds = [];
                        }
                    });

                    $('.check-item').on('change', function() {
                        var itemId = parseInt($(this).val());

                        if (this.checked) { // if new checked add to selected
                            selectedIds.push(itemId);
                        } else { // if remove checked remove from selected
                            selectedIds = selectedIds.filter(id => id !== itemId);
                        }

                        var totalCheckboxes = ids.length;
                        var checkedCheckboxes = selectedIds.length;
                        if (checkedCheckboxes === totalCheckboxes) { // all checkboxes checked
                            $('#check-all').prop('checked', true).prop('indeterminate', false);
                            selectedIds = ids.slice();
                        } else if (checkedCheckboxes > 0) { // not all checkboxes are checked
                            $('#check-all').prop('checked', false).prop('indeterminate', true);
                        } else {  // all checkboxes are not checked
                            $('#check-all').prop('checked', false).prop('indeterminate', false);
                            selectedIds = [];
                        }
                    });
                  // End of checkboxes
                }

            });

            // Initialize Components
            initLengthChange(table);
            initSearchFilter(table);
            initTypeChange(table);
            initTrashButton(table);
            // initPagination(table);
            initColumnVisibilityToggle(table);

            // Table draw event for sorting icons and pagination updates
            table.on('draw', function () {
                handlePagination(table);
                updateSortingIcons(table);
                updateInfoText(table);
            });

            $('#createLevelForm').submit(function(event) {
                event.preventDefault();
                $('#createLevelModal').modal('hide');

                if (!$(this).valid()) {
                    $('#createLevelModal').modal('show');
                    return;
                }

                $('#loading').show();

                var formData = $(this).serialize();


                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#loading').hide();
                        Swal.fire({
                            icon: response.icon,
                            title: response.state,
                            text: response.message,
                            confirmButtonText: __("Ok",lang)
                        });
                        $('#createLevelForm')[0].reset();
                        $('#createLevelForm .form-control').removeClass('valid');
                        $('#createLevelForm .form-select').removeClass('valid');
                        table.ajax.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
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

            $('#editLevelForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var id = $('#edit_id').val();
                console.log(id);

                $.ajax({
                    url: "{{ route('level.update', ':id') }}".replace(':id', id),
                    type: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang)
                    });
                    table.ajax.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
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


    // new SearchableSelect({
    //     selectId: 'user_id',
    //     url: '/clients/all',
    //     method: 'GET',
    //     csrfToken: document.querySelector('meta[name="csrf-token"]').content,
    //     renderOption: (option) => `
    //         <div class="d-flex align-items-center">
    //             <img src="${option.photo}" class="me-2" width="20" height="20">
    //             <span>${option.full_name}</span>
    //         </div>
    //     `
    // });

    // new SearchableSelect({
    //     selectId: 'edit_user_id',
    //     url: '/user/all',
    //     method: 'GET',
    //     csrfToken: document.querySelector('meta[name="csrf-token"]').content,
    //     renderOption: (option) => `
    //         <div class="d-flex align-items-center">
    //             <img src="${option.photo}" class="me-2" width="20" height="20">
    //             <span>${option.full_name}</span>
    //         </div>
    //     `
    // });



</script>

@endsection
