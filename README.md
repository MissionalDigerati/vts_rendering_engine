VTS Rendering Engine
====================

This rendering system is designed to help in the translating of video content.  It takes a translated audio file, and merges it to a video file that is stretched or reduced to the length of the audio file.  Then it merges all the clips into a single movie.  Finally,  it will create multiple versions of the file to be played on a wide array of mobile devices and websites.  This library depends on PHP's [PEAR library](http://pear.php.net/), the [FFMPEG library](http://ffmpeg.org/), the [FFMPEG-PHP Library](https://github.com/char0n/ffmpeg-php), and the [MP4Box from GPAC library](http://gpac.wp.mines-telecom.fr/).

Package
-------

This is part of the Video Translating Service Package (VTS) which consists of the following repositories:

* [Rendering Engine](https://github.com/MissionalDigerati/vts_rendering_engine)

Requirements
------------

* PHP
* [PEAR](http://pear.php.net/)
* [FFMPEG](http://ffmpeg.org/)
* [FFMPEG-PHP](https://github.com/char0n/ffmpeg-php)
* [MP4Box from GPAC library](http://gpac.wp.mines-telecom.fr/)
* Command line access

Running the Example
-------------------

From the terminal,  change to the root directory of this project.  Verify that you have correctly install all the required libraries.  Run the following command:

`php example.php`

Development
-----------

Questions or problems? Please post them on the [issue tracker](https://github.com/MissionalDigerati/vts_rendering_engine/issues). You can contribute changes by forking the project and submitting a pull request.

This script is created by Johnathan Pulos and is under the [GNU General Public License v3](http://www.gnu.org/licenses/gpl-3.0-standalone.html).