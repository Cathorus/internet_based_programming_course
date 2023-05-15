function openTab(tabName) {
  var i;
  var tabs = document.getElementsByClassName("tab");
  var tabLinks = document.getElementsByClassName("tab-link");

  for (i = 0; i < tabs.length; i++) {
    tabs[i].style.display = "none";
  }

  for (i = 0; i < tabLinks.length; i++) {
    tabLinks[i].classList.remove("active");
  }

  document.getElementById(tabName).style.display = "block";
  event.currentTarget.classList.add("active");

  // Show or hide the Announcement entry and tabs based on the active tab
  if (tabName === "announcement-tab") {
    document.getElementById("announcement-form").style.display = "block";
    document.getElementById("announcement-container").style.display = "block";
    document.getElementById("message-form").style.display = "none";
    document.getElementById("message-container").style.display = "none";
  } else if (tabName === "messages-tab") {
    document.getElementById("announcement-form").style.display = "none";
    document.getElementById("announcement-container").style.display = "none";
    document.getElementById("message-form").style.display = "block";
    document.getElementById("message-container").style.display = "block";
  } else {
    document.getElementById("announcement-form").style.display = "none";
    document.getElementById("announcement-container").style.display = "none";
    document.getElementById("message-form").style.display = "none";
    document.getElementById("message-container").style.display = "none";
  }
}

function validateLogin() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if (username === "" || password === "") {
    document.getElementById("error-message").innerHTML = "Please enter a username and password.";
    return false;
  }

  return true;
}
