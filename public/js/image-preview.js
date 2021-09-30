var images = [];
function image_select() {
    delete_image()
    var image = document.getElementById('image').files;
    for (i = 0; i < image.length; i++) {
        if (check_duplicate(image[i].name)) {
            images.push({
                "name" : image[i].name,
                "url" : URL.createObjectURL(image[i]),
                "file" : image[i],
            })
        } else
        {
            alert(image[i].name + " is already added to the list");
        }
    }

    document.getElementById('container').innerHTML = image_show();
}

function image_show() {
    var image = "";
    images.forEach((i) => {
        image += `<div class="image_container d-flex justify-content-center position-relative">
				<img src="`+ i.url +`" alt="Image">
			</div>`;
    })
    return image;
}
function delete_image() {
    const empty = arr => arr.length = 0;
    empty(images);
    document.getElementById('container').innerHTML = image_show();
}

function check_duplicate(name) {
    var image = true;
    if (images.length > 0) {
        for (e = 0; e < images.length; e++) {
            if (images[e].name == name) {
                image = false;
                break;
            }
        }
    }
    return image;
}
