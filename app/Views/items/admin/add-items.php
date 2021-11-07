<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    body {
        background: rgb(24, 25, 27);
    }
</style>
<div class="m-5">
    <div id="backdrop" class="backdrop backdrop-transition backdrop-dark">
        <div class="text-center w-100" style="position: absolute;top: 50%;">
            <div class="bg-light border rounded border-success shadow-lg m-auto" style="width: 150px;height: 150px;"><i class="fa fa-upload d-block p-4" style="font-size: 50px;"></i><span>Drop file to attach</span></div>
        </div>
    </div>
    <div class="bg-light border rounded border-light pt-1 jumbotron py-5 px-4">
        <div class="alert alert-success invisible mt-5" role="alert"><span id="notify"></span></div>
        <h1>File Drop<br></h1>
        <p><label class="form-label" for="form-files"><a class="btn btn-secondary btn-sm" role="button">Choose Files</a></label>&nbsp;or drag the files to anywhere on this page.<br></p>
        <p id="filecount"><br></p>
        <div id="list"></div>
        <form id="add-items">
            <input class="form-control invisible" type="file" id="form-files" name="files" multiple="">
            <button class="btn btn-outline-primary d-block w-100" type="submit">Submit</button>
            <button class="btn btn-danger mt-5" type="reset" onclick="clearFiles()">Reset</button>
        </form>
    </div>
    <div class="text-center bg-light border rounded border-dark shadow-lg p-3"><img id="image_preview" width="100">
        <div><button class="btn btn-warning btn-sm m-3" onclick="previewClose()">Close</button></div>
    </div>
</div>
<script src="<?= base_url('assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') ?>"></script>