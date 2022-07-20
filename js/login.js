function validateAll(event) {
  function msgPrinter(type, msg, element) {
    if (type === "err") {
      event.preventDefault();
      let msgbox = element.parentElement.getElementsByTagName("small")[0];
      msgbox.classList.toggle("err", true);
      msgbox.classList.toggle("noErr", false);
      msgbox.innerText = msg;
    } else {
      let msgbox = element.parentElement.getElementsByTagName("small")[0];
      msgbox.classList.toggle("noErr", true);
      msgbox.classList.toggle("err", false);
      msgbox.innerText = msg;
    }
  }
  let email = document.getElementsByName("email")[0];
  if (email.value === "") {
    msgPrinter("err", "Email is Required", email);
  }

  let pass = document.getElementsByName("pass")[0];
  if (pass.value === "") {
    msgPrinter("err", "Password is Required", pass);
  }
}
function loadImg() {
  let email = document.getElementsByName("email")[0];
  $.ajax({
    type: "POST",
    data: { email: email.value },
    url: "otherRes/loadImg.php",
  })
    .done(function (result) {
      if (result.length > 1) {
        document.getElementsByClassName("box")[0].innerHTML =
          `<img class="rounded-circle logo border" src=` + result + `></img>`;
        document
          .getElementsByClassName("box")[0]
          .getElementsByTagName("img")[0].style.padding = "0";
      } else {
        document.getElementsByClassName(
          "box"
        )[0].innerHTML = `<span class="bi bi-person-check rounded-circle logo"></span>`;
      }
    })
    .fail(function () {
      document.getElementsByClassName(
        "box"
      )[0].innerHTML = `<span class="bi bi-person-check rounded-circle logo"></span>`;
    });
}
document.getElementsByName("Clear")[0].addEventListener('click',()=>{
    document.getElementsByClassName("box")[0].innerHTML = `<span class="bi-person-check rounded-circle logo"></span>`;
});