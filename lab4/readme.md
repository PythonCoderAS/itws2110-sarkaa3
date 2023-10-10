1. Can you give me an HTML image tag linking to "https://science.rpi.edu/sites/default/files/styles/large/public/Updated%20CTF%20Photo%20with%20Chris.png?itok=7z339w80"
2. Do not provide an ALT tag
3. Image tag "https://science.rpi.edu/sites/default/files/styles/large/public/photo%20of%20Rick%20teaching%20for%20webpage_edited_0.jpg?itok=fG8wLNnG"
4. Image tag "https://science.rpi.edu/sites/default/files/styles/large/public/open_source.jpg?itok=cluMnYrL"
5. Image tag https://science.rpi.edu/sites/default/files/styles/large/public/Photo%20students%20website_edited.jpg?itok=ihTLC3tR
6. HTML script tag to load script.js 
7. Rename this chunk of code to use the variable name carousel instead of carouselContainer:
carouselContainer.addEventListener('mouseenter', () => {
  clearInterval(interval);
});

// Optional: Resume autoscroll on mouseout
carouselContainer.addEventListener('mouseleave', () => {
  interval = setInterval(nextSlide, intervalTime);
});
8. 