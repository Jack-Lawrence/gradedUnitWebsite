//Image preview in Upload page code
const previewImage = (event) => {
	const imageFiles = event.target.files;
	const imageFilesLength = imageFiles.length;
	if (imageFilesLength > 0) {
		const imageSrc = URL.createObjectURL(imageFiles[0]);
		const imagePreviewElement = document.querySelector("#preview-selected-image");
		imagePreviewElement.src = imageSrc;
		imagePreviewElement.style.display = "block";
	}
};

function myFunction() {
	window.location.reload();
}

//Login page contact popup
function popUp() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}

//Feed Comment Character Limit (ONLY WORKS BY ID NOT BY CLASS)
// var myText = document.getElementById("comment");
// var result = document.getElementById("result");
// var limit = 40;
// result.textContent = 0 + "/" + limit;

// myText.addEventListener("input",function(){
//     var textLength = myText.value.length;
//     result.textContent = textLength + "/" + limit;

//     if(textLength > limit){
//         myText.style.borderColor = "#ff2851";
//         result.style.color = "#ff2851";
//     }
//     else{
//         myText.style.borderColor = "#000000";
//         result.style.color = "#FFFFFF";
//     }
// });