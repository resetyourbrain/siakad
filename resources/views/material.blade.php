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
                <h5 class="card-title mb-0 flex-grow-1">Data Materi</h5>
                @auth
                    @if (auth()->user()->role === 'dosen')
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="create-btn" data-bs-target="#exampleModalAdd">
                                <i class="ri-add-line align-bottom me-1"></i> Tambah Materi
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
                            <th>Judul Materi</th>
                            <th>Mata Kuliah</th>
                            <th>Diupload</th>
                            <th>File Materi</th>
                            @auth
                                @if (auth()->user()->role === 'dosen')
                                    <th>Action</th>
                                @else
                                    <th>Dosen</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $material)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $material->title }}</td>
                            <td>{{ $material->course->kode }} - {{ $material->course->nama }}</td>
                            <td>{{ Carbon\Carbon::parse($material->published_at)->format('d F Y') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="ri-download-2-fill align-bottom"></i> Download
                                </a>
                            </td>
                            @auth
                                @if (auth()->user()->role === 'dosen')
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <form action="/material/delete/{{ $material->id }}" method="POST" class="d-inline">
                                                    @method('put')
                                                    @csrf
                                                    <button class="dropdown-item remove-item-btn" onclick="return confirm('Yakin akan menghapus materi ini ?')">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                @else
                                    <td>{{ $material->course->lecturer->user->name }}</td>
                                @endif
                            @endauth
                            <div class="modal fade" id="exampleModalScrollable{{ $material->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $material->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Deskripsi:</strong> {{ $material->title }}</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off" enctype="multipart/form-data" action="/material/add" method="POST">
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
                        <label for="title-field" class="form-label">Judul Materi<span class="text-danger">*</span></label>
                        <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" required placeholder="Judul Materi" value="{{ old('title') }}"/>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Materi</label>
                        <textarea class="form-control required" id="description" name="description" placeholder="Deskripsi Materi" rows="3">{{ old('description') }}</textarea>
                        {{-- <div class="invalid-feedback">Deskripsi is required.</div> --}}
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Materi<span class="text-danger">*</span></label>
                        <input type="file" id="file-field" name="file" class="form-control @error('file') is-invalid @enderror" required placeholder="File Materi" value="{{ old('file') }}"/>
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
