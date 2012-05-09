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
 * This script helps merge audio and video files together as one clip.  It takes a single audio file, and resizes video to match length.  Then it
 * puts them both together.  This library requires {@link http://pear.php.net/ PEAR}, {@link http://ffmpeg.org/ FFMPEG} and {@link https://github.com/char0n/ffmpeg-php ffmpeg-php} 
 * in order to use.
 *
 * @author Johnathan Pulos
 * @version 1.0
 */
class ClipBuilder {
	/**
	 * The file name of the final processed file
	 *
	 * @var string
	 * @access public
	 */
	public $final_file_name;
	
	/**
	 * The final location of completed files (Add the last slash)
	 *
	 * @var string
	 * @access public
	 */
	public $final_file_directory = 'processed/';

	/**
	 * The object holding the ffmpeg-php movie object
	 *
	 * @var object
	 * @access private
	 */
	private $ffmpeg_movie;

	/**
	 * The object holding the ffmpeg-php audio object
	 *
	 * @var object
	 * @access private
	 */
	private $ffmpeg_audio;

	/**
	 * The path to the movie file
	 *
	 * @var string
	 * @access private
	 */
	private $movie_path;

	/**
	 * The path to the audio file
	 *
	 * @var string
	 * @access private
	 */
	private $audio_path;

	/**
	 * The duration of the movie in seconds
	 *
	 * @var integer
	 * @access private
	 */
	private $movie_duration;

	/**
	 * The duration of the audio in seconds
	 *
	 * @var integer
	 * @access private
	 */
	private $audio_duration;

	/**
	 * Initialize the class
	 *
	 * @access public
	 * @var string $movie_path path to the movie file
	 * @var string $audio_path path to the audio file
	 * @var string $final_file_name the name of the the finished movie file with extension (do not add a path)
	 * @return false
	 * @author Johnathan Pulos
	 */
	public function __construct($movie_path, $audio_path, $final_file_name) {
		$this->final_file_name = $final_file_name;
		$this->movie_path = $movie_path;
		$this->audio_path = $audio_path;
		$this->ffmpeg_movie = new FFmpegMovie($movie_path);
		$this->ffmpeg_audio = new FFmpegMovie($audio_path);
		$this->movie_duration = $this->ffmpeg_movie->getDuration();
		$this->audio_duration = $this->ffmpeg_audio->getDuration();
	}

	/**
	 * Process the video and files
	 *
	 * @return string the final file name and location
	 * @access public
	 * @author Johnathan Pulos
	 */
	public function process() {
		$this->process_video();
		return $this->merge_video_and_audio();
	}

	/**
	 * Crop the video to fit the size of the audio
	 *
	 * @param integer $duration the length in seconds of the final video
	 * @return void
	 * @access private
	 * @author Johnathan Pulos
	 */
	private function process_video() {
		$pts_command = "";
		if($this->movie_duration > $this->audio_duration) {
			/**
			 * Speed up the movie
			 *
			 * @author Johnathan Pulos
			 */
			$speed = $this->movie_duration/$this->audio_duration;
			$pts_command = ' -vf "setpts=(1/'.$speed.')*PTS"';
		}else if($this->movie_duration < $this->audio_duration) {
			/**
			 * Slowdown the movie
			 *
			 * @author Johnathan Pulos
			 */
			$speed = $this->audio_duration/$this->movie_duration;
			$pts_command = ' -vf "setpts='.$speed.'*PTS"';
		}
		/**
		 * ffmpeg -i input.mp4 -vf "setpts=(1/<speed>)*PTS" output.mp4
		 * @link http://blog.grio.com/2012/01/fast-and-slow-motion-video-with-ffmpeg.html
		 *
		 * @author Johnathan Pulos
		 */
		$command = 'ffmpeg -i '.$this->movie_path.$pts_command.' ' . $this->final_file_directory . 'temp_'.$this->final_file_name;
		echo "EXECUTING: ".$command."\r\n";
		@shell_exec($command);
	}

	/**
	 * Merge the final audio and video files
	 *
	 * @return string the final file location and name
	 * @access public
	 * @author Johnathan Pulos
	 */
	private function merge_video_and_audio() {
		/**
		 * ffmpeg -i audio.wav -i video.mp4 -same_quant output.mp4
		 *
		 * @author Johnathan Pulos
		 */
		$command = "ffmpeg -i ".$this->audio_path." -i " . $this->final_file_directory . "temp_".$this->final_file_name." " . $this->final_file_directory . "".$this->final_file_name;
		echo "EXECUTING: ".$command."\r\n";
		@shell_exec($command);
		/**
		 * Remove the old temp file
		 *
		 * @author Johnathan Pulos
		 */
		unlink($this->final_file_directory . "temp_".$this->final_file_name);
		return $this->final_file_directory . "".$this->final_file_name;
	}

}
?>