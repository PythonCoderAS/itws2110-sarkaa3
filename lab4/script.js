const carousel = document.querySelector('.carousel');
const carouselItems = document.querySelectorAll('.carousel-item');
let interval;

let currentIndex = 0;
const intervalTime = 3000; // Adjust as needed (3 seconds in this example)

function nextSlide() {
  currentIndex = (currentIndex + 1) % carouselItems.length;
  updateCarousel();
}

interval = setInterval(nextSlide, intervalTime);

// Optional: Pause on hover
carousel.addEventListener('mouseenter', () => {
  clearInterval(interval);
});

// Optional: Resume autoscroll on mouseout
carousel.addEventListener('mouseleave', () => {
  interval = setInterval(nextSlide, intervalTime);
});

const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');

// Function to show the next slide
function showNextSlide() {
  currentIndex = (currentIndex + 1) % carouselItems.length;
  updateCarousel();
}

// Function to show the previous slide
function showPrevSlide() {
  currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
  updateCarousel();
}

function updateCarousel() {
  const translateX = currentIndex * -100 + '%';
  carousel.style.transform = `translateX(${translateX})`;
}

// Add event listeners to the buttons
nextButton.addEventListener('click', showNextSlide);
prevButton.addEventListener('click', showPrevSlide);