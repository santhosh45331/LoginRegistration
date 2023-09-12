function showPassword() {
  var passin = document.getElementById("lpassword");
  if (passin.type === "password") {
    passin.type = "text";
  } else {
    passin.type = "password";
  }
}