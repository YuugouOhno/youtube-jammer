window.alert('YouTube見るつもりか!?');

document.body.innerHTML += `
    <div id="myModal" class="modal">
        <p id="closeButton" class="close">&times;</p>
    </div>`;

var modal = document.getElementById("myModal");
var closeButton = document.getElementById("closeButton");

modal.style.display = "block";

window.onclick = function (event) {
    if (event.target == closeButton) {
        modal.style.display = "none";
    }
}