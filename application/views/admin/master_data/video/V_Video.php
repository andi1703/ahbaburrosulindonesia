<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data /</span> Video Dakwah
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Video YouTube</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVideo" onclick="tambahVideo()">
        <span class="tf-icons bx bx-video-plus me-1"></span>Tambah Video
    </button>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Thumbnail</th>
          <th>Judul Video</th>
          <th>ID YouTube</th>
          <th>Kategori</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($all_video)): ?>
        <tr>
            <td colspan="6" class="text-center text-muted py-4">Belum ada video. Tambahkan video pertama Anda!</td>
        </tr>
        <?php else: ?>
        <?php foreach($all_video as $v): ?>
        <tr>
          <td>
            <img src="https://img.youtube.com/vi/<?= $v['id_youtube']; ?>/mqdefault.jpg" 
                 width="130" class="rounded shadow-sm" style="min-height:73px; object-fit:cover;"
                 onerror="this.src='<?= base_url('assets/img/no-image.png') ?>';">
          </td>
          <td>
            <strong><?= htmlspecialchars($v['judul_video']); ?></strong>
            <?php if(!empty($v['keterangan'])): ?>
              <br><small class="text-muted"><?= htmlspecialchars(substr($v['keterangan'], 0, 50)) . (strlen($v['keterangan']) > 50 ? '...' : ''); ?></small>
            <?php endif; ?>
          </td>
          <td><code class="text-danger"><?= $v['id_youtube']; ?></code></td>
          <td><span class="badge bg-label-info"><?= $v['kategori_video']; ?></span></td>
          <td><small><?= date('d M Y', strtotime($v['tanggal_input'])); ?></small></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item text-success" href="https://youtube.com/watch?v=<?= $v['id_youtube']; ?>" target="_blank">
                    <i class="bx bx-play-circle me-1"></i> Lihat di YouTube
                </a>
                <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="editVideo('<?= $v['id_video']; ?>', '<?= htmlspecialchars($v['judul_video'], ENT_QUOTES); ?>', '<?= $v['id_youtube']; ?>', '<?= $v['kategori_video']; ?>', '<?= htmlspecialchars($v['keterangan'] ?? '', ENT_QUOTES); ?>')">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_video/hapus/'.$v['id_video']); ?>" 
                   onclick="return confirm('Yakin ingin menghapus video ini?')">
                    <i class="bx bx-trash me-1"></i> Hapus
                </a>
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

<?php $this->load->view('admin/master_data/video/V_Video_form'); ?>
<?php $this->load->view('admin/master_data/video/V_Video_js'); ?>
