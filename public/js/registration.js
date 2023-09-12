function showPassword() {
    var passin = document.getElementById("rpassword");
    if (passin.type === "password") {
        passin.type = "text";
    } else {
        passin.type = "password";
    }
  }