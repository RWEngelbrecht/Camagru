var video = document.querySelector("#vid");
//set video from new_upload to stream from webcam
navigator.mediaDevices.getUserMedia({video:true}).then(function(stream) {
        video.srcObject = stream;
        video.play();
    }).catch(function(error) {
        console.log("Well, that did not work.");
    });
//getContext to work with canvas
var canv = document.getElementById("uploadCanvas");
var contx = canv.getContext('2d');
//draw to canvas on click of shoot button
document.getElementById('shoot').addEventListener('click', function() {
        contx.drawImage(vid, 0, 0, 720, 480);
    });
//upload taken pic on click of submit button
document.getElementById("submit_taken").addEventListener('click', function() {
    var dataURL = canv.toDataURL('mage/png');
    console.log(dataURL);
    document.getElementById('taken').value = dataURL;
});