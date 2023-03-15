//Image preview in Upload page code
const previewImage = (event) => {
	const imageFiles = event.target.files;
	const imageFilesLength = imageFiles.length;
	if (imageFilesLength > 0) {
		const imageSrc = URL.createObjectURL(imageFiles[0]);
		const imagePreviewElement = document.querySelector("#preview__image");
		imagePreviewElement.src = imageSrc;
		imagePreviewElement.style.display = "block";
	}
};

function resetButtons()
{
	document.getElementById("postButton").className = "notselected";
	document.getElementById("followerButton").className = "notselected";
	document.getElementById("followingButton").className = "notselected";
}


function divno(pageno)
{
 
	resetButtons();
 
    switch(pageno) {
        case 0:
          // code block
            document.getElementById("postButton").className = "selected";
						var x = document.getElementById("profilePostDiv");
						var y = document.getElementById("profileFollowerDiv")
						var z = document.getElementById("profileFollowingDiv")
						if (x.style.display == "block") {
							x.style.display = "block";
							y.style.display = "none";
							z.style.display = "none";
						} else {
							x.style.display = "block";
							y.style.display = "none";
							z.style.display = "none";
						}
          break;
					case 1:
          // code block
					document.getElementById("followerButton").className = "selected";
					var x = document.getElementById("profileFollowerDiv");
					var y = document.getElementById("profilePostDiv")
					var z = document.getElementById("profileFollowingDiv")
					if (x.style.display == "block") {
						x.style.display = "block";
						y.style.display = "none";
						z.style.display = "none";
					} else {
						x.style.display = "block";
						y.style.display = "none";
						z.style.display = "none";
					}
					break;
					case 2:
          // code block
					document.getElementById("followingButton").className = "selected";
						var x = document.getElementById("profileFollowingDiv");
						var y = document.getElementById("profilePostDiv")
						var z = document.getElementById("profileFollowerDiv")
						if (x.style.display == "block") {
						x.style.display = "block";
						y.style.display = "none";
						z.style.display = "none";
						} else {
							x.style.display = "block";
							y.style.display = "none";
							z.style.display = "none";
						}
					break;
		}
	}

	const doc = document;
	const menuOpen = doc.querySelector(".menu");
	const menuClose = doc.querySelector(".close");
	const overlay = doc.querySelector(".overlay");
	
	menuOpen.addEventListener("click", () => {
		overlay.classList.add("overlay--active");
	});
	
	menuClose.addEventListener("click", () => {
		overlay.classList.remove("overlay--active");
	});


	function openMenu() {
		var overlay = doc.querySelector(".overlay");
		overlay.classList.add("overlay__active");
	}

	function closeMenu() {
		var overlay = doc.querySelector(".overlay");
		overlay.classList.remove("overlay__active");

	}
