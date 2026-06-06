<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold text-dark"><?php echo $title; ?></h1>
    <ol class="breadcrumb mb-4 shadow-sm p-2 bg-light rounded">
        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>" class="text-decoration-none">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('prodi'); ?>" class="text-decoration-none">Program Studi</a></li>
        <li class="breadcrumb-item active"><?php echo $title; ?></li>
    </ol>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm border-0 border-top border-primary border-4">
                <div class="card-header bg-white py-3 border-bottom fw-bold text-primary">
                    <i class="bi bi-card-heading me-1"></i> Form Input Data
                </div>
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="POST">
                        
                        <div class="mb-3">
                            <label for="prodi_id" class="form-label fw-semibold">ID Prodi (Manual)</label>
                            <input type="text" 
                                   name="prodi_id" 
                                   id="prodi_id" 
                                   class="form-control <?php echo form_error('prodi_id') ? 'is-invalid' : (isset($_POST['prodi_id']) ? 'is-valid' : ''); ?>" 
                                   value="<?php echo set_value('prodi_id', isset($prodi['prodi_id']) ? $prodi['prodi_id'] : ''); ?>"
                                   <?php echo ($button === 'Update') ? 'readonly bg-light' : ''; ?>
                                   placeholder="Contoh: 15">
                            <?php if (form_error('prodi_id')): ?>
                                <div class="invalid-feedback"><?php echo form_error('prodi_id'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="prodi_name" class="form-label fw-semibold">Nama Program Studi</label>
                            <input type="text" 
                                   name="prodi_name" 
                                   id="prodi_name" 
                                   class="form-control <?php echo form_error('prodi_name') ? 'is-invalid' : (isset($_POST['prodi_name']) ? 'is-valid' : ''); ?>" 
                                   value="<?php echo set_value('prodi_name', isset($prodi['prodi_name']) ? $prodi['prodi_name'] : ''); ?>"
                                   placeholder="Masukkan nama program studi">
                            <?php if (form_error('prodi_name')): ?>
                                <div class="invalid-feedback"><?php echo form_error('prodi_name'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Jenjang Strata</label>
                            
                            <?php 
                            $strata_saved = isset($prodi['prodi_strata']) ? $prodi['prodi_strata'] : '';
                            ?>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prodi_strata" id="strata_d3" value="D3"
                                    <?php echo set_radio('prodi_strata', 'D3', ($strata_saved === 'D3')); ?>>
                                <label class="form-check-label" for="strata_d3">D3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prodi_strata" id="strata_s1" value="S1"
                                    <?php echo set_radio('prodi_strata', 'S1', ($strata_saved === 'S1' || $button === 'Simpan')); ?>>
                                <label class="form-check-label" for="strata_s1">S1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prodi_strata" id="strata_s2" value="S2"
                                    <?php echo set_radio('prodi_strata', 'S2', ($strata_saved === 'S2')); ?>>
                                <label class="form-check-label" for="strata_s2">S2</label>
                            </div>

                            <?php if (form_error('prodi_strata')): ?>
                                <div class="text-danger small mt-1 d-block"><?php echo form_error('prodi_strata'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label for="fakultas_id" class="form-label fw-semibold">Fakultas</label>
                            <select name="fakultas_id" id="fakultas_id" class="form-select <?php echo form_error('fakultas_id') ? 'is-invalid' : ''; ?>">
                                <option value="">-- Pilih Fakultas --</option>
                                <?php 
                                $fakultas_saved = isset($prodi['fakultas_id']) ? $prodi['fakultas_id'] : '';
                                foreach ($fakultas as $f): 
                                ?>
                                    <option value="<?php echo $f['fakultas_id']; ?>" 
                                        <?php echo set_select('fakultas_id', $f['fakultas_id'], ($fakultas_saved == $f['fakultas_id'])); ?>>
                                        <?php echo $f['fakultas_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (form_error('fakultas_id')): ?>
                                <div class="invalid-feedback"><?php echo form_error('fakultas_id'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="<?php echo base_url('prodi'); ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save me-1"></i> <?php echo $button; ?>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>