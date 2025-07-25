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
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">
                    <a href="{{ url('/assignment') }}" class="text-decoration-none text-dark">
                        {{ $assignment->title }}
                    </a>
                </h4>
            </div><!-- end card header -->

            <div class="card-body">

                <p class="text-muted mb-4">Tanggal Deadline : {{ Carbon\Carbon::parse($assignment->tanggal_deadline)->format('d M Y') }}</p>

                @forelse ($submissions as $submission)
                    <div class="live-preview">
                        <div class="d-flex align-items-start text-muted mb-4">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ URL::asset('build/images/users/user-dummy-img.jpg') }}" class="avatar-sm rounded" alt="...">
                            </div>

                            <div class="flex-grow-1">
                                <h5 class="fs-14">{{ $submission->student->user->name }}</h5>
                                <p class="mb-1">Tanggal Upload : {{ Carbon\Carbon::parse($submission->submitted_at)->format('d M Y H:i') }}</p>
                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-primary">
                                    Download File
                                </a>
                                <p class="mb-0">{{ $submission->note }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted fst-italic">Belum ada tugas yang diupload.</p>
                @endforelse

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
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
