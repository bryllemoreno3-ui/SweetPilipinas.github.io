const track = document.querySelector('.carousel-track');
        const slides = Array.from(track.children);
        const prevBtn = document.querySelector('.carousel-btn.prev');
        const nextBtn = document.querySelector('.carousel-btn.next');
        const indicators = document.querySelector('.carousel-indicators');
        let currentIndex = 0;

        // Create indicators
        slides.forEach((_, idx) => {
            const dot = document.createElement('span');
            dot.classList.add('carousel-dot');
            if(idx === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(idx));
            indicators.appendChild(dot);
        });

        function updateCarousel() {
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
            indicators.querySelectorAll('.carousel-dot').forEach((dot, idx) => {
                dot.classList.toggle('active', idx === currentIndex);
            });
        }
        function goToSlide(idx) {
            currentIndex = idx;
            updateCarousel();
        }
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel();
        });
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        });
        // Optional: swipe support for mobile
        let startX = 0;
        track.addEventListener('touchstart', e => startX = e.touches[0].clientX);
        track.addEventListener('touchend', e => {
            let dx = e.changedTouches[0].clientX - startX;
            if(dx > 50) prevBtn.click();
            if(dx < -50) nextBtn.click();
        });