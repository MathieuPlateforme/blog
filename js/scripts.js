
let comment = document.getElementById("post");
// let deleteComment = document.querySelectorAll(".del");

comment.addEventListener("click", function()
{
    let getComment = document.getElementById("comment").value;
    let idArticle = document.getElementById("idArticle").value;
    let idUser = document.getElementById("idUser").value;
    let li = document.createElement("li");
    let postComment = document.createTextNode(getComment);

    li.appendChild(postComment);
    document.getElementById("commentsList").appendChild(li);
    sendComment(postComment, idUser, idArticle)

})

function getId(list)
{
    id = list.value;
    console.log(id);
}

/* function addEventListenerList(list, event) {
    for (var i = 0, len = list.length; i < len; i++) {
        list[i].addEventListener(event, getId(list[i]), false);
    }
}

addEventListenerList(deleteComment, 'click') */

function sendComment(postComment, idUser, idArticle)
{
    let xhttp = new XMLHttpRequest();
    let data = `comment=${postComment.textContent}&idUser=${idUser}&idArticle=${idArticle}`;

    xhttp.open("POST", "addComment.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(data);
    checkXMLRequest(xhttp);
    console.log(JSON.stringify(data));

}
function delComment(id)
{
    let xhttp = new XMLHttpRequest();
    let comment = document.getElementById(id);

    xhttp.open("POST", "delComment.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(comment);
    checkXMLRequest(xhttp);
}

function checkXMLRequest(xhttp)
{
    let error = document.getElementById("error");

    xhttp.onload = function() {
        error.innerHTML = `Loaded: ${xhttp.status} ${xhttp.response}`;
    };
    xhttp.onerror = function() {
        alert(`Network Error`);
    };
    xhttp.onprogress = function(event) {
        error.innerHTML = `Received ${event.loaded} of ${event.total}`;
    };
}


    