<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.datatables'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Tugas</h5>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'dosen'): ?>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="create-btn" data-bs-target="#exampleModalAdd">
                                <i class="ri-add-line align-bottom me-1"></i> Tambah Tugas
                            </button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="card-body">
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
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
                        <?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($assignment->course->nama); ?></td>
                            <td>
                                <a href="#!" 
                                    title="Lihat Tugas" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModalScrollable<?php echo e($assignment->id); ?>">
                                    <?php echo e($assignment->title); ?>

                                </a>
                            </td>
                            <td><?php echo e($assignment->description); ?></td>
                            <td><?php echo e(date('d F Y', strtotime($assignment->tanggal_dibuat))); ?></td>
                            <td><?php echo e(date('d F Y', strtotime($assignment->tanggal_deadline))); ?></td>
                            <td>
                                <?php if($assignment->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->role === 'dosen'): ?>
                                            <li>
                                                <a href="/assignment/collected/<?php echo e($assignment->id); ?>" class="dropdown-item">
                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item edit-item-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalEdit"
                                                        data-id="<?php echo e($assignment->id); ?>"
                                                        data-course_id="<?php echo e($assignment->course_id); ?>"
                                                        data-title="<?php echo e($assignment->title); ?>"
                                                        data-description="<?php echo e($assignment->description); ?>"
                                                        data-tanggal_deadline="<?php echo e($assignment->tanggal_deadline); ?>"
                                                        data-course_name="<?php echo e($assignment->course->nama); ?>"
                                                        data-is_active="<?php echo e($assignment->is_active); ?>">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="/assignment/delete/<?php echo e($assignment->id); ?>" method="POST" class="d-inline">
                                                    <?php echo method_field('put'); ?>
                                                    <?php echo csrf_field(); ?>
                                                    <button class="dropdown-item remove-item-btn" onclick="return confirm('Yakin akan menghapus tugas ini ?')">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="/assignment/upload/<?php echo e($assignment->id); ?>" class="dropdown-item">
                                                    <i class="ri-upload-2-fill align-bottom me-2 text-muted"></i> Upload
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                            <div class="modal fade" id="exampleModalScrollable<?php echo e($assignment->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo e($assignment->title); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Deskripsi:</strong> <?php echo e($assignment->description); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </tr>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah<span class="text-danger">*</span></label>
                            <select class="form-select select2" name="course_id" id="course_id" required autofocus>
                                    <option value="">-Pilih Mata Kuliah-</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(old('course_id') == $course->id): ?>
                                            <option value="<?php echo e($course->id); ?>" selected><?php echo e($course->nama); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($course->id); ?>"><?php echo e($course->nama); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                    </div>

                    <div class="mb-3">
                        <label for="title-field" class="form-label">Judul Tugas<span class="text-danger">*</span></label>
                        <input type="text" id="title-field" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required placeholder="Judul Tugas" value="<?php echo e(old('title')); ?>"/>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tugas<span class="text-danger">*</span></label>
                        <textarea class="form-control required" required id="description" name="description" placeholder="Deskripsi Tugas" rows="3"><?php echo e(old('description')); ?></textarea>
                        <div class="invalid-feedback">Deskripsi is required.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Deadline<span class="text-danger">*</span></label>
                        <input type="date" class="form-control <?php $__errorArgs = ['tanggal_deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="tanggal_deadline" required placeholder="Tanggal Service Berikutnya" value="<?php echo e(old('tanggal_deadline')); ?>"/>
                        <?php $__errorArgs = ['tanggal_deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
            
            <form id="form-edit-assignment" class="tablelist-form" autocomplete="off" method="POST">
                <?php echo method_field('put'); ?>
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title-field" class="form-label">Mata Kuliah<span class="text-danger">*</span></label>
                        <input type="hidden" name="course_id" id="edit-course_id" value="<?php echo e(old('course_id', $assignment->course_id)); ?>">
                        <input type="text" id="edit-course_name" name="course_name" class="form-control" disabled value="">
                        <?php $__errorArgs = ['course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="title-field" class="form-label">Judul Tugas<span class="text-danger">*</span></label>
                        <input type="text" id="edit-title-field" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required placeholder="Judul Tugas" value="<?php echo e(old('title', $assignment->title)); ?>"/>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tugas<span class="text-danger">*</span></label>
                        <textarea class="form-control required" required id="edit-description" name="description" placeholder="Deskripsi Tugas" rows="3"><?php echo e(old('description', $assignment->description)); ?></textarea>
                        <div class="invalid-feedback">Deskripsi is required.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Deadline<span class="text-danger">*</span></label>
                        <input type="date" class="form-control <?php $__errorArgs = ['tanggal_deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit-tanggal-deadline" name="tanggal_deadline" required placeholder="Tanggal Deadline" value="<?php echo e(old('tanggal_deadline', \Carbon\Carbon::parse($assignment->tanggal_deadline)->format('Y-m-d'))); ?>"/>
                        <?php $__errorArgs = ['tanggal_deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="edit-is_active" name="is_active" required>
                            <option value="1" <?php echo e(old('is_active', $assignment->is_active) == 1 ? 'selected' : ''); ?>>Aktif</option>
                            <option value="0" <?php echo e(old('is_active', $assignment->is_active) == 0 ? 'selected' : ''); ?>>Tidak Aktif</option>
                        </select>
                        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

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

<script src="<?php echo e(URL::asset('build/js/pages/datatables.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<script src="<?php echo e(URL::asset('build/js/pages/modal.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/reset/LEARN/sistem-akademik/resources/views/assignment.blade.php ENDPATH**/ ?>