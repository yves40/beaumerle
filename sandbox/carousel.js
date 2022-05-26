const track = document.querySelector('.carousel__track');
const slides = Array.from(track.children);
const nextButton = document.querySelector('.carousel__button--right');
const prevButton = document.querySelector('.carousel__button--left');
const dotsNav = document.querySelector('.carousel__nav');
const dots = Array.from(dotsNav.children);

let slideWidth = slides[0].getBoundingClientRect().width;

const setSlidePosition = (slide, index) => {
  slide.style.left = slideWidth * index + 'px';
}

slides.forEach( setSlidePosition );

const moveToSlide = (track, currentSlide, targetSlide) => {
  track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
  currentSlide.classList.remove('current-slide');
  targetSlide.classList.add('current-slide') 
}

// Left click
prevButton.addEventListener('click', e => {
  const currentSlide = document.querySelector('.current-slide');
  const prevSlide = currentSlide.previousElementSibling;
  moveToSlide(track, currentSlide, prevSlide);
})
// Right click
nextButton.addEventListener('click', e => {
  const currentSlide = document.querySelector('.current-slide');
  const nextSlide = currentSlide.nextElementSibling;
  moveToSlide(track, currentSlide, nextSlide);
})

// Nav indicator click, move to the selected slide
dotsNav.addEventListener('click', e => {
  // What indicator was clicked on ? 
  const targetDot = e.target;
  // Check an indicator has been clicked (not elsewhere in the parent)
  if(!targetDot.classList.contains('carousel__indicator')) {
    return;
  }
  const currentSlide = track.querySelector('.current-slide');
  const currentDot = dotsNav.querySelector('.current-slide');
  const targetIndex = dots.findIndex(dot => dot === targetDot); // Returns the index
  const targetSlide = slides[targetIndex];
  moveToSlide(track, currentSlide, targetSlide);
})

// Track window resize
window.onresize =  () =>  {
  slideWidth = slides[0].getBoundingClientRect().width; 
  console.log(slideWidth);
};