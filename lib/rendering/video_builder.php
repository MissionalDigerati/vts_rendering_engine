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
 * -------------------------------------------------------------------
 * 
 * This class combines multiple videos into a single movie.
 * This library requires {@link http://pear.php.net/ PEAR}, {@link http://ffmpeg.org/ FFMPEG}, {@link https://github.com/char0n/ffmpeg-php ffmpeg-php} and 
 * {@link MP4Box from GPAC library} in order to use.
 *
 * @author Johnathan Pulos
 * @version 1.0
 * @todo Add check to make sure all videos are the same format
 */
class VideoBuilder {
	
	/**
	 * The final location of completed files (Add the last slash)
	 *
	 * @var string
	 * @access public
	 */
	public $final_file_directory = 'processed/';
	
	/**
	 * Array of clips to join together
	 *
	 * @var array
	 */
	private $clips = array();
	
	/**
	 * Initialize the class
	 *
	 * @access public
	 * @author Johnathan Pulos
	 */
	function __construct() {
	}
	
	/**
	 * Add a clip to the clips array
	 *
	 * @var string clip the clip to be added
	 * @return void
	 * @access public
	 * @author Johnathan Pulos
	 */
	function add_clip($clip) {
		array_push($this->clips, $clip);
	}
	
	/**
	 * Process the video builder by adding the clips together in the order they were received
	 *
	 * @var string final_file_name the final filename to process
	 * @return string the final file location and name of completed file
	 * @access public
	 * @author Johnathan Pulos
	 */
	function process($final_file_name) {
		$first_clip = $this->clips[0];
		$cat_files = array_shift($this->clips);
		$command = "MP4Box -force-cat ". $first_clip ." -cat ". implode(' -cat ', $this->clips) . " -out " . $this->final_file_directory . $final_file_name . ".mp4";
		echo "EXECUTING: ".$command."\r\n";
		@shell_exec($command);
	}
}
?>