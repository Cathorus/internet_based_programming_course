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

  // Show or hide the Announcement and Medicines sections based on the active tab and user type
  if (tabName === "announcement-tab") {
    if (userType === "doctor") {
      document.getElementById("announcement-form").style.display = "none";
      document.getElementById("announcement-container").style.display = "none";
    }else {
      document.getElementById("announcement-form").style.display = "block";
      document.getElementById("announcement-container").style.display = "none";
    }
  } else if (tabName === "medicines-tab") {
    if (userType === "doctor") {
      // Show the medicine form for doctors
      document.getElementById("medicine-form").style.display = "none";
      document.getElementById("medicine-container").style.display = "none";
      document.getElementById("medicine-error").style.display = "none";
    } else {
      // Show the message for non-doctors (patients)
      document.getElementById("medicine-form").style.display = "block";
      document.getElementById("medicine-container").style.display = "none";
      document.getElementById("medicine-error").style.display = "block";
    }
  }
}

// Set the user type (doctor/patient) based on your authentication logic, Since I'm unable to merge this code with PHP at the moment, we need to assign it here.
var userType = "patient";
