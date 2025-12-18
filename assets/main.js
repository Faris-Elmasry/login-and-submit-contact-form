// Accordion functionality
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

// Auto-hide messages after 5 seconds
setTimeout(function () {
  var messages = document.querySelectorAll(".message");
  messages.forEach(function (msg) {
    msg.style.display = "none";
  });
}, 9000);
