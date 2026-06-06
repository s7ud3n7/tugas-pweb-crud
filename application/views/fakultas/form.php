<div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title; ?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url('fakultas'); ?>">Fakultas</a></li>
        <li class="breadcrumb-item active"><?php echo $title; ?></li>
    </ol>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-card-heading me-1"></i>
                    Form <?php echo $title; ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="POST">
                        
                        <div class="mb-3">
                            <label Improvement for="fakultas_id" class="form-label">ID Fakultas (Manual)</label>
                            <input type="text" 
                                   name="fakultas_id" 
                                   id="fakultas_id" 
                                   class="form-control <?php echo form_error('fakultas_id') ? 'is-invalid' : (isset($_POST['fakultas_id']) ? 'is-valid' : ''); ?>" 
                                   value="<?php echo set_value('fakultas_id', isset($fakultas['fakultas_id']) ? $fakultas['fakultas_id'] : ''); ?>"
                                   <?php echo ($button === 'Update') ? 'readonly bg-light' : ''; ?>
                                   placeholder="Contoh: 8">
                            <?php if (form_error('fakultas_id')): ?>
                                <div class="invalid-feedback"><?php echo form_error('fakultas_id'); ?></div>
                            <?php endif; ?>
                            <?php if ($button === 'Update'): ?>
                                <div class="form-text text-muted">ID Fakultas tidak dapat diubah dalam mode pembaruan data.</div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="fakultas_name" class="form-label">Nama Fakultas</label>
                            <input type="text" 
                                   name="fakultas_name" 
                                   id="fakultas_name" 
                                   class="form-control <?php echo form_error('fakultas_name') ? 'is-invalid' : (isset($_POST['fakultas_name']) ? 'is-valid' : ''); ?>" 
                                   value="<?php echo set_value('fakultas_name', isset($fakultas['fakultas_name']) ? $fakultas['fakultas_name'] : ''); ?>"
                                   placeholder="Masukkan nama fakultas">
                            <?php if (form_error('fakultas_name')): ?>
                                <div class="invalid-feedback"><?php echo form_error('fakultas_name'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="<?php echo site_url('fakultas'); ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> <?php echo $button; ?>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>