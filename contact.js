document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('contactForm');
    var popup = document.getElementById('messageSentPopup');
    if(form && popup) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            form.reset();
            popup.style.display = 'flex';
        });
    }
});

