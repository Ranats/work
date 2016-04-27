/**
 * Created by coda on 16/04/27.
 */

// Stream connections ... ?


//var details = document.getElementsByClassName("tweet-action-item pull-left margin-r--13");
//var details = document.querySelectorAll("div footer");
var details = document.getElementsByClassName("tweet-action-item");

console.log(details.length);
for (var i=0; i<details.length; i++){
    console.log(details[i].className);

    var p = document.createElement("li");
    p.className = "tweet-action-item pull-right margin-r--13";
    details[i].appendChild(p);

}

console.log(details);
console.log(details.length);
