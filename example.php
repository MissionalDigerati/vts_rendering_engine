<?php
/**
 * This file is part of Open Bible Stories Rendering Engine.
 * 
 * Open Bible Stories Rendering Engine is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Open Bible Stories Rendering Engine is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see 
 * <http://www.gnu.org/licenses/>.
 *
 * @author Johnathan Pulos <johnathan@missionaldigerati.org>
 * @copyright Copyright 2012 Missional Digerati
 * 
 * This is an example file on how to use the rendering system.
 */
require_once "lib/rendering.php";
$video = new VideoBuilder();
$video->final_file_directory = 'completed/';
/**
 * Merge the first audio file with a clip
 *
 * @author Johnathan Pulos
 */
$clip = new ClipBuilder('example_files/video/TheCompassionateFather1.mp4', 'example_files/audio/audio_3.mp3', '8_sec_audio.mp4');
$clip->final_file_directory = 'completed/';
$final_clip = $clip->process();
/**
 * Add the new file to the clips of the VideoBuilder
 *
 * @author Johnathan Pulos
 */
$video->add_clip($final_clip);
/**
 * Merge the second audio file with a clip
 *
 * @author Johnathan Pulos
 */
$clip2 = new ClipBuilder('example_files/video/TheCompassionateFather1.mp4', 'example_files/audio/audio_2.mp3', '14_sec_audio.mp4');
$clip2->final_file_directory = 'completed/';
$final_clip2 = $clip2->process();
/**
 * Add the new file to the clips of the VideoBuilder
 *
 * @author Johnathan Pulos
 */
$video->add_clip($final_clip2);
/**
 * Merge the third audio file with a clip
 *
 * @author Johnathan Pulos
 */
$clip3 = new ClipBuilder('example_files/video/TheCompassionateFather1.mp4', 'example_files/audio/audio_1.mp3', '19_sec_audio.mp4');
$clip3->final_file_directory = 'completed/';
$final_clip3 = $clip3->process();
/**
 * Add the new file to the clips of the VideoBuilder
 *
 * @author Johnathan Pulos
 */
$video->add_clip($final_clip3);
/**
 * Process the video by combining the two clips
 *
 * @author Johnathan Pulos
 */
$video->process('bible_story_project');
?>