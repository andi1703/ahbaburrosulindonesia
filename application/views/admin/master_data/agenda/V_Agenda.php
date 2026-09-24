<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data /</span> Agenda Kajian
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Jadwal Kegiatan Majelis</h5>
    <a href="<?= base_url('index.php/back_agenda/tambah'); ?>" class="btn btn-primary">
        <span class="tf-icons bx bx-calendar-plus me-1"></span>Buat Agenda Baru
    </a>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="10%">Poster</th>
          <th>Waktu &amp; Tanggal</th>
          <th>Nama Kegiatan</th>
          <th>Pengisi / Narasumber</th>
          <th>Tempat</th>
          <th>Lokasi Maps</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($all_agenda)): ?>
        <tr>
            <td colspan="8" class="text-center text-muted py-5">
                <i class="bx bx-calendar-x bx-lg d-block mb-2 text-secondary"></i>
                Belum ada agenda. Buat jadwal kegiatan pertama Anda!
            </td>
        </tr>
        <?php else: ?>
        <?php foreach($all_agenda as $ag): ?>
        <?php
            $label_map = ['mendatang' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
            $status    = $ag['status_kegiatan'];
            $label     = isset($label_map[$status]) ? $label_map[$status] : 'secondary';
            $is_mendatang = ($status == 'mendatang');
        ?>
        <tr class="<?= $is_mendatang ? '' : 'opacity-75'; ?>">
          <td>
            <img src="<?= base_url('assets/img/poster_agenda/'.($ag['poster'] ?? '')); ?>"
                 alt="Poster" class="rounded shadow-sm" width="80"
                 onerror="this.src='<?= base_url('assets/img/no-image.png') ?>';">
          </td>
          <td>
            <div class="d-flex flex-column">
              <strong class="<?= $is_mendatang ? 'text-primary' : ''; ?>">
                <?= date('d M Y', strtotime($ag['tanggal'])); ?>
              </strong>
              <small class="text-muted"><i class="bx bx-time me-1"></i><?= date('H:i', strtotime($ag['jam'])); ?> WIB</small>
            </div>
          </td>
          <td>
            <strong><?= htmlspecialchars($ag['nama_kegiatan']); ?></strong>
            <?php if(!empty($ag['keterangan'])): ?>
              <br><small class="text-muted"><?= htmlspecialchars(substr($ag['keterangan'], 0, 40)) . (strlen($ag['keterangan']) > 40 ? '...' : ''); ?></small>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($ag['pengisi_kajian']); ?></td>
          <td><?= htmlspecialchars($ag['tempat']); ?></td>
          <td>
            <?php if(!empty($ag['Maps'])): ?>
            <a href="<?= $ag['Maps']; ?>" target="_blank" class="btn btn-sm btn-outline-success">
                <i class="bx bx-map-alt me-1"></i>Lihat Map
            </a>
            <?php else: ?>
            <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <td>
            <span class="badge bg-label-<?= $label; ?>"><?= ucfirst($status); ?></span>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item text-warning" href="<?= base_url('index.php/back_agenda/edit/'.$ag['id_agenda']); ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_agenda/hapus/'.$ag['id_agenda']); ?>" onclick="return confirm('Yakin ingin menghapus agenda ini?')"><i class="bx bx-trash me-1"></i> Hapus</a>
              </div>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
