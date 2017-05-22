'use strict';

/* globals MediaRecorder */

// Spec is at http://dvcs.w3.org/hg/dap/raw-file/tip/media-stream-capture/RecordingProposal.html

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;


if(getBrowser() == "Chrome"){
	var constraints = {"audio": true, "video": {  "mandatory": {  "minWidth": 414,  "maxWidth": 640, "minHeight": 480,"maxHeight": 736 }, "optional": [] } };//Chrome
}else if(getBrowser() == "Firefox"){
	var constraints = {audio: true, video: {  width: { min: 640, ideal: 640, max: 640 },  height: { min: 480, ideal: 480, max: 480 }}}; //Firefox
}

var recBtn = document.querySelector('button#rec');
var pauseResBtn = document.querySelector('button#pauseRes');
var stopBtn = document.querySelector('button#stop');
var saveBtn = document.querySelector('button#save');

var videoElement = document.querySelector('video');
var dataElement = document.querySelector('#data');
var downloadLink = document.querySelector('a#downloadLink');

videoElement.controls = false;

function errorCallback(error){
	console.log('navigator.getUserMedia error: ', error);	
}

var mediaRecorder;
var chunks = [];
var count = 0;
var blob;

function saveVideo(hash, apid) {	
	var formData = new FormData();
	formData.append('apid', apid);
	formData.append('hash', hash);
	formData.append('video-blob', blob);
	xhrVideo($urlProj + '_actions/media.php', formData, function (fName) {		
	 	var filename = videoElement.src;
	    var w = videoElement.videoWidth;
	    var h = videoElement.videoHeight;
	    var canvas = document.createElement('canvas');
	    canvas.width = w;
	    canvas.height = h;
	    var ctx = canvas.getContext('2d');
	    ctx.drawImage(video, 0, 0, w, h);
	    var data = canvas.toDataURL("image/jpg");	    
	    var xmlhttp = new XMLHttpRequest;	    
	    xmlhttp.onreadystatechange = function(){
	        if (xmlhttp.readyState==4 && xmlhttp.status==200){
	            location.reload();
	        }
	    }	    	    
	    xmlhttp.open("POST", $urlProj + '_actions/media.php', true);
	    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	    xmlhttp.send('apid='+apid+'&thumb='+encodeURIComponent(filename)+'&hash='+hash+'&data='+data);		
	});
}

function xhrVideo(url, data, callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            callback(location.href + request.responseText);
        }
    };
    request.open('POST', url);
    //request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);
}

function startTimer(duration) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;        
        if (--timer < 0) {
			onBtnStopClicked();
            timer = duration;			
        }
    }, 1000);
}

function startRecording(stream) {
	log('Start recording...');	
    startTimer(10);
	if (typeof MediaRecorder.isTypeSupported == 'function'){		
		if (MediaRecorder.isTypeSupported('video/webm;codecs=h264')) {
		  var options = {mimeType: 'video/webm;codecs=h264'};
		} else if (MediaRecorder.isTypeSupported('video/webm;codecs=vp9')) {
		  var options = {mimeType: 'video/webm;codecs=vp9'};
		} else if (MediaRecorder.isTypeSupported('video/webm;codecs=vp8')) {
		  var options = {mimeType: 'video/webm;codecs=vp8'};
		}
		mediaRecorder = new MediaRecorder(stream, options);
	}else{
		mediaRecorder = new MediaRecorder(stream);
	}

	mediaRecorder.start(10);

	var url = window.URL || window.webkitURL;
	videoElement.src = url ? url.createObjectURL(stream) : stream;
	videoElement.play();

	mediaRecorder.ondataavailable = function(e) {		
		chunks.push(e.data);
	};

	mediaRecorder.onerror = function(e){
		console.log('Error: ', e);
	};


	mediaRecorder.onstart = function(){
		//log('Started & state = ' + mediaRecorder.state);
	};

	mediaRecorder.onstop = function(){
		blob = new Blob(chunks, {type: "video/webm"});
		chunks = [];

		var videoURL = window.URL.createObjectURL(blob);

		downloadLink.href = videoURL;
		videoElement.src = videoURL;
		downloadLink.innerHTML = 'Baixar Video';

		var rand =  Math.floor((Math.random() * 10000000));
		var name  = "video_"+rand+".webm";

		downloadLink.setAttribute( "download", name);
		downloadLink.setAttribute( "name", name);
		saveBtn.disabled = false;
		
	};

	mediaRecorder.onpause = function(){
		//log('Paused & state = ' + mediaRecorder.state);
	}

	mediaRecorder.onresume = function(){
		//log('Resumed  & state = ' + mediaRecorder.state);
	}

	mediaRecorder.onwarning = function(e){
		//log('Warning: ' + e);
	};
}

function onBtnRecordClicked (){
	 if (typeof MediaRecorder === 'undefined' || !navigator.getUserMedia) {
		alert('MediaRecorder not supported on your browser, use Firefox 30 or Chrome 49 instead.');
	}else {
		alert('Grave seu video pessoal de ate 10 segundos!');
		navigator.getUserMedia(constraints, startRecording, errorCallback);
		recBtn.disabled = true;
		pauseResBtn.disabled = false;
		stopBtn.disabled = false;
	}
}

function onBtnStopClicked(){
	mediaRecorder.stop();
	videoElement.controls = true;

	recBtn.disabled = false;
	pauseResBtn.disabled = true;
	stopBtn.disabled = true;
}

function onPauseResumeClicked(){
	if(pauseResBtn.textContent === "Pause"){
		console.log("pause");
		pauseResBtn.innerHTML = '<i class="fa fa-pause-circle"></i>';
		mediaRecorder.pause();
		stopBtn.disabled = true;
	}else{
		console.log("resume");
		pauseResBtn.innerHTML = '<i class="fa fa-pause"></i>';
		mediaRecorder.resume();
		stopBtn.disabled = false;
	}
	recBtn.disabled = true;
	pauseResBtn.disabled = false;
}


function log(message){
	dataElement.innerHTML = dataElement.innerHTML+'<br>'+message ;
}



//browser ID
function getBrowser(){
	var nVer = navigator.appVersion;
	var nAgt = navigator.userAgent;
	var browserName  = navigator.appName;
	var fullVersion  = ''+parseFloat(navigator.appVersion);
	var majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;

	// In Opera, the true version is after "Opera" or after "Version"
	if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
	 browserName = "Opera";
	 fullVersion = nAgt.substring(verOffset+6);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1)
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In MSIE, the true version is after "MSIE" in userAgent
	else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	 browserName = "Microsoft Internet Explorer";
	 fullVersion = nAgt.substring(verOffset+5);
	}
	// In Chrome, the true version is after "Chrome"
	else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	 browserName = "Chrome";
	 fullVersion = nAgt.substring(verOffset+7);
	}
	// In Safari, the true version is after "Safari" or after "Version"
	else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	 browserName = "Safari";
	 fullVersion = nAgt.substring(verOffset+7);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1)
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In Firefox, the true version is after "Firefox"
	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	 browserName = "Firefox";
	 fullVersion = nAgt.substring(verOffset+8);
	}
	// In most other browsers, "name/version" is at the end of userAgent
	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
		   (verOffset=nAgt.lastIndexOf('/')) )
	{
	 browserName = nAgt.substring(nameOffset,verOffset);
	 fullVersion = nAgt.substring(verOffset+1);
	 if (browserName.toLowerCase()==browserName.toUpperCase()) {
	  browserName = navigator.appName;
	 }
	}
	// trim the fullVersion string at semicolon/space if present
	if ((ix=fullVersion.indexOf(";"))!=-1)
	   fullVersion=fullVersion.substring(0,ix);
	if ((ix=fullVersion.indexOf(" "))!=-1)
	   fullVersion=fullVersion.substring(0,ix);

	majorVersion = parseInt(''+fullVersion,10);
	if (isNaN(majorVersion)) {
	 fullVersion  = ''+parseFloat(navigator.appVersion);
	 majorVersion = parseInt(navigator.appVersion,10);
	}


	return browserName;
}
