@extends('layouts.master')
@section('title') @lang('translation.datatables') @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Tugas</h5>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="create-btn" data-bs-target="#exampleModalAdd"><i class="ri-add-line align-bottom me-1"></i> Tambah Tugas</button>
                </div>
            </div>
            <div class="card-body">
                <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Matkul</th>
                            <th>Judul Tugas</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Tugas</th>
                            <th>Tanggal Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $assignment->course->nama }}</td>
                            <td>
                                <a href="#!" 
                                    title="Lihat Tugas" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModalScrollable{{ $assignment->id }}">
                                    {{ $assignment->title }}
                                </a>
                            </td>
                            <td>{{ $assignment->description }}</td>
                            <td>{{ date('d F Y', strtotime($assignment->tanggal_dibuat)) }}</td>
                            <td>{{ date('d F Y', strtotime($assignment->tanggal_deadline)) }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="#!" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                            </a>
                                        </li>
                                        {{-- <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </td>
                            <div class="modal fade" id="exampleModalScrollable{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $assignment->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Deskripsi:</strong> {{ $assignment->description }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off" action="/pic/add" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name-field" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" id="name-field" name="name" class="form-control @error('name') is-invalid @enderror" required placeholder="PIC Name" value="{{ old('name') }}"/>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" id="email-field" name="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Email" value="{{ old('email') }}"/>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password-input">Password</label>
                        <div class="position-relative auth-pass-inputgroup">
                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="password-input" name="password" aria-describedby="passwordInput" pattern=".{6,}" required>
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                        </div>
                        <div id="passwordInput" class="form-text">Must be at least 6 characters.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="confirm-password-input">Confirm Password</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Confirm password" pattern=".{6,}" id="confirm-password-input" name="password_confirmation" required>
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                        </div>
                    </div>

                    <div class="invalid-feedback d-none" id="password-match-error">
                        Password and Confirm Password do not match!
                    </div>

                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                        <h5 class="fs-13">Password must contain:</h5>
                        <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>6 characters</b></p>
                    </div>

                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="text" id="phone-field" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                            required placeholder="Phone Number" value="{{ old('phone') }}"
                            pattern="[+0-9]*" title="Phone number can only contain numbers and a plus sign." />
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('script')


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
