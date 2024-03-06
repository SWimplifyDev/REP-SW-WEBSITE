
// Efect to zoom in elements
function zoom(element){
    element.style.transform = "scale(1.5)";
}

// Change color to "Green" on active elements
function greenActive(id){
    //document.getElementById(id).style.textShadow = "0 0 1rem rgb(83, 79, 79)";
    document.getElementById(id).style.color = "#86af49";
}

function grayInactive(id){
    document.getElementById(id).style.textShadow = "0 0 1rem rgb(83, 79, 79)";
}

// Show hidden elements
function display_on(id){
    document.getElementById(id).style.display = "unset";
}

// It validates RIMID format (Only numbers, 9 characters, no spaces)
function validateForm() {
    let x = document.forms["rimidInput"]["rimId"].value;
    if (x == "" || isNaN(x) || x.length != 9 || (/\s/.test(str))) {
      alert("Invalid RimId Format");
      return false;
    }
  }