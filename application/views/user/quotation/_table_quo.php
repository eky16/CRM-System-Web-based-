    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
 
               <thead >
            <tr>
                <th class="col-no">No</th>
                <th class="col-id">Id Quotation</th>
                <th class="col-tgl">Tgl Pesan</th>
                <th class="col-tgl">Tgl Follow Up</th>
                <th class="col-cust">Customer</th>
                <th>Nama Barang</th>
                <th class="col-sales">Sales</th>
                <th class="col-status">Status</th>
                <th width="50">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($all_quo as $row): ?>

                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="font-weight-bold text-primary"><?= $row->number_quo ?></td>
                    <td><?= $row->trans_Date ?></td>
                    <td><?= $row->follow_up_date ?></td>
                    <td><?= $row->nama_cst ?></td>
                    <td><?= $row->detailName_quo ?></td>
                    <td><span class="badge badge-light border"><?= $row->nama_karyawan ?></span></td>
                    <td class="text-center"><span class="badge badge-info"><?= $row->status_qr_quo ?></span></td>
                    <td class="text-center">
                        <a href="<?= base_url('user/quotation/detail_quo/' . $row->id) ?>" class="btn btn-info btn-circle btn-sm" title="Detail">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
