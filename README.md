README
======

Ultimate yet another images resizer.


Author
------

* "Anton Bondar" <anton@zebooka.com> — http://zebooka.com


Installation
------------

Run `make` to build phar package.
Add `build/resizer-s1000.phar` to directory within your executable path.
For example, add it to `/usr/local/bin/` directory.
Set executable flag — `chmod +x resizer-s1000.phar`.


Requirements
------------

You need `composer` to build images resizer tool.
You need to install `convert` (Image Magick) as well. This program is actually used to resize images.


Usage
-----

`resizer-s1000.phar -t PATH [options] FROM_PATH [ FROM_PATH ... ]`

Run `resizer-s1000.phar -h` to get full options list.


License
-------

Standard MIT License — http://opensource.org/licenses/MIT

http://zebooka.com/soft/LICENSE/

Copyright (c) 2014, Anton Bondar.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
