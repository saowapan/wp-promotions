(function($) {

	var wpp_mediaUpload = {

		init:function() {
			//todo
			this.addUploads();
		},
		addUploads:function() {
			var input = $('#file');

			var fd = new FormData();
			fd.append('action', 'upload_image');
			fd.append('image', input.get(0).files[0]);
			
			var allowed = ["jpeg", "png"];
			
			allowed.forEach(function(extension){
				if(input.get(0).files[0].type.match('image/'+extension)) {
					//Correct mimeType
					$.ajax({
						xhr: function() {

					        var xhr = new window.XMLHttpRequest();
					        xhr.upload.addEventListener("progress", function(evt) {
					            if (evt.lengthComputable) {
					                var percentComplete = Math.round(evt.loaded / evt.total * 100);
					                //Do something with upload progress here
					                $('#image-loading').show();
					                $('#media-percentage').html('');
					                $('#media-percentage').append(percentComplete + "%");
					                if(percentComplete === 100) {
					                	$('#image-loading').hide();
					                } else {
					                	$('#loading-text').show();
					                }
					            }
					       }, false);

					       return xhr;
					    },
						url: mediaupload.ajaxurl,
						type: 'POST',
						data: fd,
						processData: false,
						contentType: false,
						success: function( result ) {

							console.log(result);
							$('#attach_id').val(result);
							wpp_mediaUpload.previewImage(input.get(0));
							input.prop('disabled', true);
							$('#remove-container').show();
							$('#upload-container').hide();

							if($('#current-image').length) {
								$('#current-image').hide();
							}
						}
					});
					
				} else {
					//Incorrect mimeType
				}
			});
		},
		removeUploads:function() {
			var input = $('#file');
			var attach_id = $('#attach_id').val();

			if(!attach_id == '') {
				//image to remove

				$.ajax({
					url: mediaupload.ajaxurl,
					type: 'POST',
					data: {
						action: 'remove_image',
						attach_id: attach_id
					},
					success: function( result ) {

						console.log(result);
						if(result == 1) {
							$('#attach_id').html('');
							$('#remove-container').hide();
							$('#image-loading').hide();
							$('#upload-container').show();
							input.prop('disabled', false);
						} else {

						}

					}
				});

			} else {
				//no image to remove
			}
		},
		removeUploader:function() {
			//todo
		},
		previewImage:function(input) {
			if(input.files[0]) {
				var image = new FileReader();

				image.onload = function(e) {
					$('#media-preview').attr('src', e.target.result);
				}

				image.readAsDataURL(input.files[0]);
			}
		}
	};
	//upload image
	$('#mediaUpload').on('click', function(e){
		e.preventDefault();
		wpp_mediaUpload.init();
	});
	//remove image
	$('#remove-mediaUpload').on('click', function(e) {
		e.preventDefault();
		wpp_mediaUpload.removeUploads();
	});

	//set datepicker on input
	$('#promoStart').datepicker();
	$('#promoEnd').datepicker();

})(jQuery);