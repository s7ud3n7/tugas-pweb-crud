<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold text-dark"><?php echo $title; ?></h1>
    <ol class="breadcrumb mb-4 shadow-sm p-2 bg-light rounded">
        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>" class="text-decoration-none">Dashboard</a></li>
        <li class="breadcrumb-item active">Fakultas</li>
    </ol>

    <div class="card mb-4 shadow-sm border-0 border-top border-primary border-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <div class="fw-bold text-primary">
                <i class="bi bi-building me-2"></i> Data Master Fakultas
            </div>
            <a href="<?php echo base_url('fakultas/tambah'); ?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Fakultas
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-borderless border-bottom" id="datatable" width="100%" cellspacing="0">
                    <thead class="table-light text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                        <tr>
                            <th width="8%">No.</th>
                            <th width="18%">ID Master</th>
                            <th>Nama Fakultas</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($fakultas as $f): ?>
                            <tr>
                                <td class="fw-bold text-muted"><?php echo $no++; ?></td>
                                <td><span class="badge bg-light text-dark border px-2 py-1"><?php echo $f['fakultas_id']; ?></span></td>
                                <td class="fw-semibold text-dark"><?php echo $f['fakultas_name']; ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url('fakultas/ubah/' . $f['fakultas_id']); ?>" class="btn btn-outline-warning btn-sm rounded-3 me-1" title="Ubah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?php echo base_url('fakultas/hapus/' . $f['fakultas_id']); ?>" class="btn btn-outline-danger btn-sm rounded-3 btn-hapus" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>