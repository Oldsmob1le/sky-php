document.addEventListener('DOMContentLoaded', function() {
    const paymentItems = document.querySelectorAll('.payment-item');

    function toggleBackground(event) {
        const element = event.currentTarget;

        element.classList.toggle('active');
    }
    paymentItems.forEach(function(item) {
        item.addEventListener('click', toggleBackground);
    });
});