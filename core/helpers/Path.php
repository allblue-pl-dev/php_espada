<?php namespace E;
defined('_ESPADA') or die(NO_ACCESS);


class Path
{

	static public function Media($package_name, $file_path)
	{
		$package_name = mb_strtolower($package_name);
        $fs_file_path = PATH_MEDIA . '/' . $package_name . '/' . $file_path;

		return $fs_file_path;
	}

}
