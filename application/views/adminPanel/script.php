<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		setTimeout(function(){ $(".alert-messages").remove(); }, 3000);
		<?php if (isset($dataTables)): ?>
      	var table = $('.datatable').DataTable({
            // dom: 'Bfrtip',
            /*lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10', '25', '50', '100', 'All' ]
            ],*/
            /*buttons: [
                'pageLength',
                {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'pdf',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'csv',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'copy',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                'colvis'
            ],
            columnDefs: [ {
                targets: -1,
                visible: false
            } ],*/
            "processing": true,
            "serverSide": true,
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': 'Processing',
                'paginate': {
                    'first': '|',
                    'next': '<i class="fa fa-arrow-circle-right"></i>',
                    'previous': '<i class="fa fa-arrow-circle-left"></i>',
                    'last': '|'
                }
            },
            "order": [],
            "ajax": {
                url: "<?= base_url($url) ?>",
                type: "POST",
                data: function(data) {
                    data.star_line_token = $('#'+"<?= strtolower(str_replace(" ", '_', APP_NAME)).'_token' ?>").val();
                    /*data.prod_id = $('#prod_id').val();*/
                },
                complete: function(response) {
                    var data = JSON.parse(response.responseText).star_line_token;
                    $('#'+"<?= strtolower(str_replace(" ", '_', APP_NAME)).'_token' ?>").val(data);
                },
            },
            "columnDefs": [{
                "targets": 'target',
                "orderable": false,
            },],
        });

        $('#galleryUploadForm').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(data){
                    table.ajax.reload();
                    $('#galleryUploadForm').trigger("reset");
                    if (data.error === false)  Swal.fire("Done!", data.message, "success");
                    else Swal.fire("Error!", data.message, "error");
                },
                error: function(data){
                    Swal.fire("Sorry!", "Something is not going good. Please try later.", "error");
                }
            });
        }));

        /*$('#buyer_id, #seller_id, #prod_id').change(function(){
            table.ajax.reload();
        });*/

        <?php endif ?>
	});
    
    function remove(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This will be deleted from your data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.value) $('#'+id).submit();
      })
    }

    function showImages(id)
    {
        $.ajax({
            type:'POST',
            url: '<?= base_url($url) ?>/showImages/'+$('#upload-id').val(),
            cache:false,
            success:function(data){
                $('#uploaded-images').html(data);
            },
            error: function(data){
                $('#uploaded-images').html('<div class="col-12"><div class="alert alert-danger">No Image uploaded.</div></div>');
            }
        });
    }

    function uploadImage()
    {
        $('#imageUploadForm').submit();
    }

    function galleryUploadForm()
    {
        $('#galleryUploadForm').submit();
    }

    function selectImage(image)
    {
        $("#gallery_image").val(image);
        $('#select-gallery').modal('hide');
        image = "<?= base_url('assets/gallery/') ?>" + image;
        $('#show-img').attr('src', image);
    }

    function getGallery()
    {
        $.ajax({
            type:'GET',
            url: '<?= base_url($url) ?>/getGallery?route=<?= $this->uri->segment(3) ?>',
            cache:false,
            success:function(data){
                if (data.length > 0) {
                    $(".modal-body").html(data);
                    $('#select-gallery').modal('show');
                }else
                    Swal.fire("Error!", "No images to display. Upload gallery images first.", "error");
            },
            error: function(data){
                Swal.fire("Error!", "Something not going good.", "error");
            }
        });
    }

    <?php if (isset($id)): ?>
    function uploadImages()
    {
        let id = <?= $id ?>;
        $.ajax({
            type:'POST',
            url: '<?= base_url($url) ?>/uploadImages',
            data: {id: id, image:$("#images").val()},
            dataType: 'json',
            cache:false,
            success:function(data){
                if (data.error === false) {
                    Swal.fire("Done!", data.message, "success");
                    $('#select-gallery').modal('hide');
                    showImages(id);
                }
                else Swal.fire("Error!", data.message, "error");
            },
            error: function(data){
                showImages(id);
            }
        });
    }
    <?php endif ?>

    function removeImage(id, image) 
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure to remove this image?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.value)
                $.ajax({
                    type:'POST',
                    url: '<?= base_url($url) ?>/removeImage',
                    data: {id: id, image:image},
                    dataType: 'json',
                    cache:false,
                    success:function(data){
                        showImages(id);
                        if (data.error === false)  Swal.fire("Done!", data.message, "success");
                        else Swal.fire("Error!", data.message, "error");
                    },
                    error: function(data){
                        showImages(id);
                    }
                });
          });
    }

    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                showImages($('#upload-id').val());
                $('#imageUploadForm').trigger("reset");
                if (data.error === false)  Swal.fire("Done!", data.message, "success");
                else Swal.fire("Error!", data.message, "error");
            },
            error: function(data){
                Swal.fire("Sorry!", "Something is not going good. Please try later.", "error");
            }
        });
    }));

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#show-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function(){
        readURL(this);
    });

    function myCopyFunction(image) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(image).select();
      document.execCommand("copy");
      $temp.remove();
      Swal.fire("Done!", "Image url copied.", "success");
    }
</script>