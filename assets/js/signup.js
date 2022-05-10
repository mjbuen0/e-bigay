// for the field of occupation and income
function selectRole() {
    var role = document.getElementById("account-role").value;
    // alert(role);
    if (role == 'Recipient') {
        document.getElementById("occupationfield").hidden = false;
        document.getElementById("incomefield").hidden = false;
        document.getElementById("regoccupation").setAttribute("required", "true");
        document.getElementById("regincome").setAttribute("required", "true");
    } else {
        document.getElementById("occupationfield").hidden = true;
        document.getElementById("incomefield").hidden = true;
        document.getElementById("regoccupation").removeAttribute("required");
        document.getElementById("regincome").removeAttribute("required");
    }
}