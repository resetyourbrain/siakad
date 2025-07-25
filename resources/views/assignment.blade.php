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
                @auth
                    @if (auth()->user()->role === 'dosen')
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="create-btn" data-bs-target="#exampleModalAdd">
                                <i class="ri-add-line align-bottom me-1"></i> Tambah Tugas
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
                <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Matkul</th>
                            <th>Judul Tugas</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Tugas</th>
                            <th>Tanggal Deadline</th>
                            <th>Status</th>
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
                                @if($assignment->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                    @auth
                                        @if (auth()->user()->role === 'dosen')
                                            <li>
                                                <a href="/assignment/collected/{{ $assignment->id }}" class="dropdown-item">
                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item edit-item-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalEdit"
                                                        data-id="{{ $assignment->id }}"
                                                        data-course_id="{{ $assignment->course_id }}"
                                                        data-title="{{ $assignment->title }}"
                                                        data-description="{{ $assignment->description }}"
                                                        data-tanggal_deadline="{{ $assignment->tanggal_deadline }}"
                                                        data-course_name="{{ $assignment->course->nama }}"
                                                        data-is_active="{{ $assignment->is_active }}">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="/assignment/delete/{{ $assignment->id }}" method="POST" class="d-inline">
                                                    @method('put')
                                                    @csrf
                                                    <button class="dropdown-item remove-item-btn" onclick="return confirm('Yakin akan menghapus tugas ini ?')">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        @else
                                            <li>
                                                <a href="/assignment/upload/{{ $assignment->id }}" class="dropdown-item">
                                                    <i class="ri-upload-2-fill align-bottom me-2 text-muted"></i> Upload
                                                </a>
                                            </li>
                                        @endif
                                    @endauth
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
            <form class="tablelist-form" autocomplete="off" action="/assignment/add" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah<span class="text-danger">*</span></label>
                            <select class="form-select select2" name="course_id" id="course_id" required autofocus>
                                    <option value="">-Pilih Mata Kuliah-</option>
                                    @foreach ($courses as $course)
                                        @if(old('course_id') == $course->id)
                                            <option value="{{ $course->id }}" selected>{{ $course->nama }}</option>
                                        @else
                                            <option value="{{ $course->id }}">{{ $course->nama }}</option>
                                        @endif
                                    @endforeach
                            </select>
                    </div>

                    <div class="mb-3">
                        <label for="title-field" class="form-label">Judul Tugas<span class="text-danger">*</span></label>
                        <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" required placeholder="Judul Tugas" value="{{ old('title') }}"/>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tugas<span class="text-danger">*</span></label>
                        <textarea class="form-control required" required id="description" name="description" placeholder="Deskripsi Tugas" rows="3">{{ old('description') }}</textarea>
                        <div class="invalid-feedback">Deskripsi is required.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Deadline<span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_deadline') is-invalid @enderror" name="tanggal_deadline" required placeholder="Tanggal Service Berikutnya" value="{{ old('tanggal_deadline') }}"/>
                        @error('tanggal_deadline')
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

<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            {{-- <form class="tablelist-form" autocomplete="off" action="assignment/update/{id}" method="POST"> --}}
            <form id="form-edit-assignment" class="tablelist-form" autocomplete="off" method="POST">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title-field" class="form-label">Mata Kuliah<span class="text-danger">*</span></label>
                        <input type="hidden" name="course_id" id="edit-course_id" value="{{ old('course_id', $assignment->course_id) }}">
                        <input type="text" id="edit-course_name" name="course_name" class="form-control" disabled value="">
                        @error('course_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title-field" class="form-label">Judul Tugas<span class="text-danger">*</span></label>
                        <input type="text" id="edit-title-field" name="title" class="form-control @error('title') is-invalid @enderror" required placeholder="Judul Tugas" value="{{ old('title', $assignment->title) }}"/>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tugas<span class="text-danger">*</span></label>
                        <textarea class="form-control required" required id="edit-description" name="description" placeholder="Deskripsi Tugas" rows="3">{{ old('description', $assignment->description) }}</textarea>
                        <div class="invalid-feedback">Deskripsi is required.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Deadline<span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_deadline') is-invalid @enderror" id="edit-tanggal-deadline" name="tanggal_deadline" required placeholder="Tanggal Deadline" value="{{ old('tanggal_deadline', \Carbon\Carbon::parse($assignment->tanggal_deadline)->format('Y-m-d')) }}"/>
                        @error('tanggal_deadline')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('is_active') is-invalid @enderror" id="edit-is_active" name="is_active" required>
                            <option value="1" {{ old('is_active', $assignment->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $assignment->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('is_active')
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-item-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const deadline = this.getAttribute('data-tanggal_deadline');
            const formatted = new Date(deadline).toISOString().slice(0, 10);
            const courseId = this.getAttribute("data-course_id");
            const courseName = this.getAttribute("data-course_name");
            const isActive = this.getAttribute("data-is_active");


            document.querySelector('#edit-title-field').value = title;
            document.querySelector('#edit-description').value = description;
            document.querySelector('#edit-tanggal-deadline').value = deadline;
            document.getElementById('edit-tanggal-deadline').value = formatted;
            document.querySelector("#edit-course_id").value = courseId;
            document.querySelector("#edit-course_name").value = courseName;
            document.querySelector('#edit-is_active').value = isActive;

            const form = document.querySelector('#form-edit-assignment');
            form.action = `/assignment/update/${id}`;
        });
    });
});
</script>


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
