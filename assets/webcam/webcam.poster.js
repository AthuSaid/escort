$(document).ready(function() {
	
	 $('#show-camera').click(function() {
	   	 $(this).hide();
	   	 //$("#fileupload").hide();
	   	 $("#cropper").hide();
	   	 $("#webcam").show(); 
	   	$("#popup-webcam-take-photo").show();
     });
	
	 $("#webcam").webcam({
         swffile: $urlProj + "assets/webcam/sAS3Cam.swf?v="+Math.random(),

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
                 $("#popup-webcam-take-photo").removeAttr('disabled');                                  
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

             $('#popup-webcam-take-photo').click(function() {
                 var result = cameraApi.save();
                 if (result && result.length) {
                	 
                	 $("#cropper").show();
                	 
                     var actualShotResolution = cameraApi.getResolution();

                     var img = new Image();
                     img.src = 'data:image/jpeg;base64,' + result;
                     
                     console.log(cropPortrait);
                     cropPortrait.source_webcam = true;
                     cropPortrait.url = img.src;                     
                     $('.avatar-src').val(img.src);
                     cropPortrait.startCropper();
                     
                     $("#webcam").hide();
                     
                     //alert('base64encoded jpeg (' + actualShotResolution[0] + 'x' + actualShotResolution[1] + '): ' + result.length + 'chars');

                     /* resume camera capture */
                     cameraApi.setCamera($("#popup-webcam-cams").val());
                 } else {
                     cameraApi.debug('error', 'Broken camera');
                 }
             });


             var reload = function() {
                 $('#popup-webcam-take-photo').show();
             };

             $('#popup-webcam-save').click(function() {
                     reload();
             });
         }
     });
	 $("#webcam").hide();
	 $("#popup-webcam-take-photo").hide();
  });