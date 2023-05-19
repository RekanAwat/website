$(document).ready(function () {
    const check = 0;
    if (check == 0) {
        document.getElementById('errormsg').style.display = 'none';
    }

    function check() {
        document.getElementById('errormsg').style.display = 'block';
        check = 1;
    }
});