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
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($assignment->title); ?></h4>
                
            </div><!-- end card header -->
            <form class="tablelist-form" autocomplete="off" enctype="multipart/form-data" action="/submission/add" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <p><strong>Deskripsi :</strong> <?php echo e($assignment->description); ?></p>
                    <div class="mb-3">
                        <label for="file-field" class="form-label">Upload Tugas<span class="text-danger">*</span></label>
                        <input type="hidden" name="assignment_id" id="edit-assignment_id" value="<?php echo e(old('assignment_id', $assignment->id)); ?>">
                        <input type="file" id="file-field" name="file" class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required placeholder="Judul Tugas" value="<?php echo e(old('file')); ?>"/>
                        <?php $__errorArgs = ['file'];
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
                        <label for="note" class="form-label">Keterangan</label>
                        <textarea class="form-control required" id="note" name="note" placeholder="Keterangan Tugas" rows="3"><?php echo e(old('note')); ?></textarea>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-start">
                        
                        <a href="<?php echo e(url('/assignment')); ?>" class="btn btn-light">Kembali</a>
                        <button type="submit" class="btn btn-success" id="add-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/reset/LEARN/sistem-akademik/resources/views/assignment-upload.blade.php ENDPATH**/ ?>