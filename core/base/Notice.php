<?php namespace E;
defined('_ESPADA') or die(NO_ACCESS);


class Notice
{

    static private $Fields = null;
    static private $Notices = [];

    static public function Add($message)
    {
        $notice = [
            'message' => $message,
            'stack' => ''
        ];

        $fields = self::GetFields();

        $backtrace = debug_backtrace();
        $js_backtrace = [];
        for ($i = 0; $i < count($backtrace); $i++) {
            if (array_key_exists('file', $backtrace[$i])) {
                $js_backtrace[] = $backtrace[$i]['file'] . ':' .
                        $backtrace[$i]['line'];
            } else
                $js_backtrace[] = 'Undefined';
        }

        $js = '<script type="text/javascript">';
        $js .= "console.groupCollapsed('Espada: {$message}');";
        foreach ($js_backtrace as $js_backtrace_file)
            $js .= "console.warn('  ' + " . json_encode($js_backtrace_file) . ");";
        $js .= 'console.groupEnd();';
        $js .= '</script>';

        $notice['stack'] .= "\n    #" . $js_backtrace[0];
        self::$Notices[] = $notice;
        
        $fields['raw'] .= $js;
    }

    static public function GetAll()
    {
        return self::$Notices;
    }

    static public function GetL()
    {
        return Layout::_('Basic:raw', self::GetFields());
    }

    static private function GetFields()
    {
        if (self::$Fields === null) {
            self::$Fields = [
                'raw' => ''
            ];
        }

        return self::$Fields;
    }

}
