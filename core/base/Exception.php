<?php namespace E;
defined('_ESPADA') or die(NO_ACCESS);


class Exception
{

	static public function ErrorHandler($errno, $errstr, $errfile,
			$errline, $errcontext)
	{
		throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
	}

	static public function ExceptionHandler($e)
	{
		if (!EDEBUG)
			die (INTERNAL_ERROR_MESSAGE);

		echo '<b>Exception:</b> ' . $e->getMessage() . '<br /><br />'."\n\n";

		$backtrace_array = $e->getTrace();

		array_unshift($backtrace_array, [
			'file' => $e->getFile(),
			'line' => $e->getLine()
		]);

		foreach ($backtrace_array as $backtrace_line) {
			if (isset($backtrace_line['file']))
				echo '<b>' . $backtrace_line['file'] . '</b>[line: <b>' . $backtrace_line['line'].'</b>]:'.'<br />'."\n";
			else
				echo '<b>Unknown</b><br />' . "\n";

			if (isset($backtrace_line['function'])) {
				echo "\t" . '&nbsp;&nbsp;&nbsp;' . $backtrace_line['function'] .
						'<br />' . "\n";
			} else
				echo "\t" . '&nbsp;&nbsp;&nbsp; Unknown <br />';
		}

		die();
	}

	// static public function ShutdownHandler()
	// {
	// 	$error = error_get_last();
	//
	// 	if ($error === null)
	// 		return;
	//
	// 	throw new \Exception($error['message'], $error['type'], 0,
	// 			$error['file'], $error['line']);
	// }

}
