# Quiz 2



## Part 3
Located at https://sarkaa3rpi169285.eastus.cloudapp.azure.com/itws2110-sarkaa3/quiz2/index.php

The original code is copied from Lab 6 (https://teambitphotos.eastus.cloudapp.azure.com/lab6/).

Links:

* https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/hidden

Issues faced:

1. A lot of the DB code was hardcoded only for the websys.json file. It had to be rewritten with a ternary so that if the new "mbe" query parameter was present, it would use the new mbe.json file.