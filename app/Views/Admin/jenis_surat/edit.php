<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">FORM Ubah Jenis Surat</h6>
                    </div>
                </div>
            </div>
            <form action="<?= base_url('jenis_surat/update'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_jenis_surat" value="<?= $jenis_surat['id_jenis_surat']; ?>">
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> <?= session()->getFlashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> <?= session()->getFlashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="nama_jenis_surat">Nama Jenis Surat</label>
                        <input type="text" name="nama_jenis_surat" id="nama_jenis_surat"
                            class="form-control <?= ($validation->hasError('nama_jenis_surat')) ? 'is-invalid' : ''; ?>"
                            required placeholder="Masukkan nama jenis surat"
                            value="<?= $jenis_surat['nama_jenis_surat']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_jenis_surat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kode_jenis_surat">Kode Jenis Surat</label>
                        <input type="text" name="kode_jenis_surat" id="kode_jenis_surat"
                            class="form-control <?= ($validation->hasError('kode_jenis_surat')) ? 'is-invalid' : ''; ?>"
                            required placeholder="Masukkan kode jenis surat"
                            value="<?= $jenis_surat['kode_jenis_surat']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode_jenis_surat'); ?>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="ket_jenis_surat">Ket Jenis Surat</label>
                        <textarea name="ket_jenis_surat" id="ket_jenis_surat"
                            class="form-control <?= ($validation->hasError('ket_jenis_surat')) ? 'is-invalid' : ''; ?>"
                            required
                            placeholder="Masukkan ket jenis surat"><?= $jenis_surat['ket_jenis_surat']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('ket_jenis_surat'); ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="persyaratan" class="form-label">Persyaratan</label>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button
                                            class="btn btn-link btn-block text-left collapsed bg-transparent border-0 text-black"
                                            type="button" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Pilih Persyaratan
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php 
                                        $data_deatail = array_column($detail_jenis_surat, 'id_persyaratan');
                                    foreach($persyaratan as $ref): ?>
                                        <!-- checkbox -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="<?= $ref['id_persyaratan']; ?>" name="persyaratan[]"
                                                value="<?= $ref['id_persyaratan']; ?>"
                                                <?= (in_array($ref['id_persyaratan'], $data_deatail)) ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="<?= $ref['id_persyaratan']; ?>"><?= $ref['nama_persyaratan']; ?></label>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="template_jenis_surat">Template Surat</label>
                        <textarea id="editor2" name="template_jenis_surat" rows="10" cols="80"
                            placeholder="Masukkan template surat"><?= $jenis_surat['template_jenis_surat']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('template_jenis_surat'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="<?= base_url('jenis_surat'); ?>" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
CKEDITOR.replace('editor1', {
    height: 250,
    baseFloatZIndex: 10005,
    //clipboard_handleImages: false,
    extraPlugins: 'image2,uploadimage',
    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

    // Upload dropped or pasted images to the CKFinder connector (note that the response type is set to JSON).
    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

    // Reduce the list of block elements listed in the Format drop-down to the most commonly used.
    format_tags: 'p;h1;h2;h3;pre',
    // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
    //removeDialogTabs: 'image:advanced;link:advanced',
    toolbarGroups: [{
            name: 'document',
            groups: ['mode', 'document', 'doctools']
        },
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo']
        },
        {
            name: 'editing',
            groups: ['find', 'selection', 'spellchecker', 'editing']
        },
        {
            name: 'forms',
            groups: ['forms']
        },
        '/',
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup']
        },
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
        },

        {
            name: 'links',
            groups: ['links']
        },
        {
            name: 'insert',
            groups: ['insert']
        },
        '/',
        {
            name: 'styles',
            groups: ['styles']
        },
        {
            name: 'colors',
            groups: ['colors']
        },
        {
            name: 'tools',
            groups: ['tools']
        },
        {
            name: 'others',
            groups: ['others']
        },
        {
            name: 'about',
            groups: ['about']
        }
    ],
    removeButtons: 'ExportPdf,Save,NewPage,Templates,About,Smiley,Iframe,Link,Anchor,Unlink,Blockquote,CreateDiv,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Scayt,PasteFromWord'
});
CKEDITOR.replace('editor2', {
    height: 250,
    baseFloatZIndex: 10005,
    //clipboard_handleImages: false,
    extraPlugins: 'image2,uploadimage',
    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    filebrowserBrowseUrl: '<?= base_url(); ?>ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '<?= base_url(); ?>ckfinder/ckfinder.html?type=Images',
    filebrowserUploadUrl: '<?= base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '<?= base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

    // Upload dropped or pasted images to the CKFinder connector (note that the response type is set to JSON).
    uploadUrl: '<?= base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

    // Reduce the list of block elements listed in the Format drop-down to the most commonly used.
    format_tags: 'p;h1;h2;h3;pre',
    // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
    //removeDialogTabs: 'image:advanced;link:advanced',
    toolbarGroups: [{
            name: 'document',
            groups: ['mode', 'document', 'doctools']
        },
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo']
        },
        {
            name: 'editing',
            groups: ['find', 'selection', 'spellchecker', 'editing']
        },
        {
            name: 'forms',
            groups: ['forms']
        },
        '/',
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup']
        },
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
        },
        {
            name: 'links',
            groups: ['links']
        },
        {
            name: 'insert',
            groups: ['insert']
        },
        '/',
        {
            name: 'styles',
            groups: ['styles']
        },
        {
            name: 'colors',
            groups: ['colors']
        },
        {
            name: 'tools',
            groups: ['tools']
        },
        {
            name: 'others',
            groups: ['others']
        },
        {
            name: 'about',
            groups: ['about']
        }
    ],
    removeButtons: 'ExportPdf,Save,NewPage,Templates,About,Smiley,Iframe,Link,Anchor,Unlink,Blockquote,CreateDiv,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Scayt,PasteFromWord'
});
</script>
<?= $this->endSection(); ?>