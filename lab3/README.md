# Lab 3

My first challenge was choosing which CSS framework to use (or make my own). For simplicity, I decided to use Bootstrap as I would not have to make up my own components and just use premade components. However, I did not want to have to solely rely on Bootstrap so I have some styles of my own.

Bootstrap: 

* Text: https://getbootstrap.com/docs/5.3/utilities/text/#font-size
* Columns: https://getbootstrap.com/docs/5.3/layout/columns/
* Carousel: https://getbootstrap.com/docs/5.3/components/carousel/

My second challenge was choosing the second API to use. After consulting https://developer.vonage.com/en/blog/the-ultimate-list-of-fun-apis-for-your-next-coding-project, I decided to use a NASA API and make it astronomy themed. I was initially going to use the Mars Weather API, but it was no longer working. My second choice was therefore the AOPD API, which served an "Astronomy Picture of the Day". 

While this API worked, a minor challenge was that it sometimes returned YouTube videos, so I had to make a fix for that. My crude solution was to just keep on fetching previous photos until they were no longer YouTube bideos. While this is an inefficient fix, as the worst case scenario is a lot of YouTube videos in a row, there's almost never more than one YouTube video at a time.

Background image: https://www.w3schools.com/cssref/css3_pr_background-size.php
Set background image from JS: https://www.w3schools.com/jsref/prop_style_backgroundimage.asp
Center div: https://www.w3schools.com/howto/howto_css_center-vertical.asp
Make promise from non-promise: https://zellwk.com/blog/converting-callbacks-to-promises/