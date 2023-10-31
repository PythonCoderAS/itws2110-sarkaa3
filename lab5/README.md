# Lab 5

https://sarkaa3rpi169285.eastus.cloudapp.azure.com/itws2110-sarkaa3/lab5/

Optimizations:

1. Combined CSS selectors to reduce duplicate code. This optimization reduces the number of bytes sent to the frontend.
2. Replaced comb and letter PNG images with SVG images. SVG images are smaller than PNGs so it reduces the number of bytes sent to the frontend.
3. JS is moved to an external file and loaded with the `defer` attribute. This prevents JS execution from stopping the page from rendering until execution is done.
4. Styling is moved from JS to CSS as part of separation of concerns.
5. Reduced multiple `document.getElementByID(elementID)` calls for the same ID into one single call that is stored to a variable and then reused
6. Minified the CSS so less bytes are sent to the client.
7. Minified the JS so less bytes are sent to the client.