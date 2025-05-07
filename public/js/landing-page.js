let cont = 1;

document.getElementById("radio1").checked = true;

setInterval ( function() {
    nextImage();
}, 3000)

function nextImage(){
    cont++;
    if (cont > 5) {
        cont = 1;
    }
    document.getElementById("radio"+cont).checked = true;
}