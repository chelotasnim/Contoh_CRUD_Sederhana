const alert_box = document.querySelectorAll('.alert-box');
alert_box.forEach(box => {
    box.addEventListener(
        'click', function () {
            box.remove();
        }
    );
});