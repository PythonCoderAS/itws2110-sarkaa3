# Quiz 2



## Part 3
Located at https://sarkaa3rpi169285.eastus.cloudapp.azure.com/itws2110-sarkaa3/quiz2/index.php

The original code is copied from Lab 6 (https://teambitphotos.eastus.cloudapp.azure.com/lab6/). I have *creatively* re-used the stylesheets and added some humor to the title and logo.

How to get new MBE courses:

1. Click ‘Create lectures’
2. Click ‘Create labs’
3. Click ‘View New Table’
4. A new ‘Switch Between WebSys and MBE’ button will appear that allows you to switch.

To get back, just click the ‘View New Table’ button again


Links:

* https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/hidden

Issues faced:

1. A lot of the DB code was hardcoded only for the websys.json file. It had to be rewritten with a ternary so that if the new "mbe" query parameter was present, it would use the new mbe.json file.