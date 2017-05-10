$(document).ready(function() {
	
	 $('#show-camera2').click(function() {
	   	 if (!$("#webcam2").is(":visible")){
	   		 $("#cropper2").hide();
		   	 $("#webcam2").show();		   	 
	   	 }else{
	   		 $("#cropper2").show();
		   	 $("#webcam2").hide();
	   	 }	   	
     });
	
	 $("#webcam2").webcam({
         swffile: $urlProj + "assets/webcam/sAS3Cam2.swf?v="+Math.random(),

         previewWidth: 621,
         previewHeight: 500,

         resolutionWidth: 621,
         resolutionHeight: 500,
		
		 videoDeblocking: 0,
		 videoSmoothing: 1,

         StageScaleMode: 'showAll', //

         StageAlign: 'TL', 

         noCameraFound: function () {
             this.debug('error', 'Web camera is not available');
         },

         swfApiFail: function(e) {
             this.debug('error', 'Internal camera plugin error');
         },

         cameraDisabled: function () {
             this.debug('error', 'Please allow access to your camera');
         },

         debug: function(type, string) {
             if (type == 'error') {
                 $(".webcam-error").html(string);
             } else {
                 $(".webcam-error").html('');
             }
         },

         cameraEnabled:  function () {
             this.debug('notice', 'Camera enabled');
             var cameraApi = this;
             if (cameraApi.isCameraEnabled) {
                 return;
             } else {
                 cameraApi.isCameraEnabled = true;
             }
             var cams = cameraApi.getCameraList();

             for(var i in cams) {
                 //$("#popup-webcam-cams").append("<option value='"+i+"'>" + cams[i] + "</option>");
             }

             setTimeout(function() {
                 $("#popup-webcam-take-photo2").removeAttr('disabled');                                  
                 cameraApi.setCamera('0');                 
             }, 750);

             $("#popup-webcam-cams").change(function() {
                 var success = cameraApi.setCamera($(this).val());
                 if (!success) {
                     cameraApi.debug('error', 'Unable to select camera');
                 } else {
                     cameraApi.debug('notice', 'Camera changed');
                 }
             });

             $('#popup-webcam-take-photo2').click(function() {
                 var result = cameraApi.save();               
                 if (result && result.length) {
                	 
                	 $("#cropper2").show();
                	 
                     var actualShotResolution = cameraApi.getResolution();

                     var img = new Image();
                     img.src = 'data:image/jpeg;base64,' + result;
                     
                     console.log(cropGallery);
                     cropGallery.source_webcam = true;
                     cropGallery.url = img.src;                     
                     $('.avatar-src').val(img.src);
                     cropGallery.startCropper();
                     
                     $("#webcam2").hide();
                     
                     //alert('base64encoded jpeg (' + actualShotResolution[0] + 'x' + actualShotResolution[1] + '): ' + result.length + 'chars');

                     /* resume camera capture */
                     cameraApi.setCamera($("#popup-webcam-cams").val());
                 } else {
                     cameraApi.debug('error', 'Broken camera');
                 }
             });


             var reload = function() {
                 $('#popup-webcam-take-photo2').show();
             };

             $('#popup-webcam-save2').click(function() {
                     reload();
             });
         }
     });
	 $("#webcam2").hide();
	 //$("#popup-webcam-take-photo").hide();
  });