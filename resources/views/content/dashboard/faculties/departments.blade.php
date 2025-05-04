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
                <li class="nav-item"><a class="nav-link" href="{{ route('faculty.get', $faculty->id) }}"><span class="mdi mdi-cog-outline me-2"></span>{{ __('Edit Faculty') }}</a></li>
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><span class="mdi mdi-key-outline me-2"></span>{{ __('Departments') }}</a></li>
            </ul>

            <div class="row {{ app()->getLocale() == "ar" ? "me-1" : "ms-1" }} mb-2">
                <input type="text" class="form-control my-w-fit-content m-1" id="dataTables_my_filter" placeholder="{{ __('Search ...') }}" name="search">
    
                <select class="form-select my-w-fit-content m-1" id="dataTables_my_length" name="length">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
    
                <button class="btn btn-icon btn-outline-primary m-1" id="" data-bs-toggle="modal" data-bs-target="#createFacultyModal"><span class="mdi mdi-plus-outline"></span></button>
    
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
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Name (Arabic)') }}</th>
                            <th>{{ __('Description') }}</th>        
                            <th>{{ __('Created At') }}</th>
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


        <script type="text/javascript">
            var table;
            // Start of checkboxes
            var selectedIds = [];
            var ids = [];
            let isCheckAllTrigger = false;
            // End of checkboxes
    
            // function editDepartment(id) {
            //     $('#loading').show();
    
            //     $.ajax({
            //         url: '/faculty/' + id,
            //         type: 'GET',
            //         headers: {
            //             'X-CSRF-TOKEN': csrfToken
            //         },
            //         success: function(data) {
            //         faculty = data.data;
            //         console.log(faculty);
            //         $('#edit_id').val(faculty.id);
            //         $('#edit_code').val(faculty.code);
            //         $('#edit_name').val(faculty.name);
            //         $('#edit_name_ar').val(faculty.name_ar);
            //         $('#edit_email').val(faculty.email);
            //         $('#edit_description').val(faculty.description);
    
            //         $('#loading').hide();
            //         $('#editFacultyModal').modal('show');
            //         },
            //         error: function(xhr, textStatus, errorThrown) {
            //             const response = JSON.parse(xhr.responseText);
            //             $('#loading').hide();
            //             Swal.fire({
            //                 icon: response.icon,
            //                 title: response.state,
            //                 text: response.message,
            //                 confirmButtonText: __("Ok",lang)
            //             });
            //         }
            //     });
    
            // }
    
            function deleteDepartment(id) {
                confirmDelete({
                    id: id,
                    url: '/department',
                    table: table
                });
            }
    
            function viewDepartment(id) {
                window.location.href = "{{ route('department.get', '') }}/" + id;
            }
    
            function showContextMenu(id, x, y) {
    
                var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
                    .append('<li><a onclick="viewDepartment(' + id + ')"><i class="tf-icons mdi mdi-arrow-right {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
                    .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
                    .append('<li><a onclick="deleteDepartment(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');
    
    
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
                        "zeroFaculties": "<div id='no-data-animation' style='width: 100%; height: 200px;'></div>"
                    },
                    ajax: {
                        url: "{{ route('faculties.departments', ['id' => $faculty->id]) }}",
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
                        {data: 'email', name: '{{__("Email")}}'},
                        {data: 'name', name: '{{__("Name")}}'},
                        {data: 'name_ar', name: '{{__("Name (Arabic)")}}'},
                        {data: 'description', name: '{{__("Description")}}'},
                        {data: 'created_at', name: '{{__("Created At")}}'},
                        {data: 'actions', name: '{{__("Actions")}}', orderable: false, searchable: false}
                    ],
                    order: [[7, 'desc']], // Default order by created_at column
    
                    rowCallback: function(row, data) {
                        $(row).attr('id', 'faculty_' + data.id);
    
                        // $(row).on('dblclick', function() {
                        //     window.location.href = "{{ url('faculty') }}/" + data.id;
                        // });
    
                        $(row).on('contextmenu', function(e) {
                            e.preventDefault();
                            showContextMenu(data.id, e.pageX, e.pageY);
                        });
    
                        // Start of checkboxes
                        var $checkbox = $(row).find('.check-item');
                        var facultyId = parseInt($checkbox.val());
    
                        if (selectedIds.includes(facultyId)) {
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
    
                $('#createFacultyForm').submit(function(event) {
                    event.preventDefault();
                    $('#createFacultyModal').modal('hide');
    
                    if (!$(this).valid()) {
                        $('#createFacultyModal').modal('show');
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
                            $('#createFacultyForm')[0].reset();
                            $('#createFacultyForm .form-control').removeClass('valid');
                            $('#createFacultyForm .form-select').removeClass('valid');
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
    
                $('#editFacultyForm').submit(function(event) {
                    event.preventDefault();
    
                    var formData = $(this).serialize();
                    var id = $('#edit_id').val();
                    console.log(id);
    
                    $.ajax({
                        url: "{{ route('faculty.update', ':id') }}".replace(':id', id),
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
