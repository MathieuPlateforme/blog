
let comment = document.getElementById("post");

comment.addEventListener("click", function()
{
    let getComment = document.getElementById("comment").value;

    let li = document.createElement("li");
    let postComment = document.createTextNode(getComment);
    li.appendChild(postComment);
    document.getElementById("commentsList").appendChild(li);
})