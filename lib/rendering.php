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
 * This library requires {@link http://pear.php.net/ PEAR}, {@link http://ffmpeg.org/ FFMPEG}, {@link https://github.com/char0n/ffmpeg-php ffmpeg-php} and 
 * {@link http://gpac.wp.mines-telecom.fr/ MP4Box from GPAC library} in order to use.
 * 
 */
require_once 'FFmpegPHP2/FFmpegAutoloader.php';
require_once 'rendering/clip_builder.php';
require_once 'rendering/video_builder.php';
?>