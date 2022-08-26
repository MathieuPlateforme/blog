
let comment = document.getElementById("post");

comment.addEventListener("click", function()
{
    let getComment = document.getElementById("comment").value;

    let li = document.createElement("li");
    let postComment = document.createTextNode(getComment);
    li.appendChild(postComment);
    document.getElementById("commentsList").appendChild(li);

    sendComment(postComment)

})

function sendComment(postComment)
{
    let xhttp = new XMLHttpRequest();
    let data = "comment="+JSON.stringify(postComment)+"&idUser="+4+"&idArticle="+25;
    let error = document.getElementById("error");

    console.log('Voiçi le contenu de ', postComment);

    xhttp.open("POST", "addComment.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(data);
    console.log(JSON.stringify(data));

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
    