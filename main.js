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
}
