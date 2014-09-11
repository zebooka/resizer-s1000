<?php

namespace Zebooka\Resizer;

use Zebooka\Utils\Cli\Parameters;

/**
 * @property bool $help
 * @property bool $verboseLevel
 * @property null|string $logFile
 * @property int $logLevel
 * @property bool $simulate
 * @property int $limit
 * @property bool $recursive
 * @property array $from
 * @property string $to
 * @property null|string $executableName
 */
class Configure
{
    const PATHS_FROM_STDIN = '-';

    const P_HELP = 'h';
    const P_VERBOSE_LEVEL = 'E';
    const P_LOG_FILE = 'o';
    const P_LOG_LEVEL = 'O';
    const P_SIMULATE = 's';
    const P_LIMIT = 'l';
    const P_NO_RECURSIVE = 'R';
    const P_FROM = 'f';
    const P_TO = 't';

    public $help = false;
    public $verboseLevel = 100;
    public $logFile = null;
    public $logLevel = 250;
    public $simulate = false;
    public $limit = 0;
    public $recursive = true;
    public $from = array();
    public $to;
    public $executableName;

    public function __construct(array $argv)
    {
        $argv = $this->decodeArgv($argv);

        $this->help = !empty($argv->{self::P_HELP});
        $this->verboseLevel = (array_key_exists(self::P_VERBOSE_LEVEL, $argv) ? intval($argv->{self::P_VERBOSE_LEVEL}) : $this->verboseLevel);
        $this->logFile = (array_key_exists(self::P_LOG_FILE, $argv) ? strval($argv->{self::P_LOG_FILE}) : $this->logFile);
        $this->logLevel = (array_key_exists(self::P_LOG_LEVEL, $argv) ? intval($argv->{self::P_LOG_LEVEL}) : $this->logLevel);
        $this->simulate = !empty($argv->{self::P_SIMULATE});
        $this->limit = (array_key_exists(self::P_LIMIT, $argv) ? intval($argv->{self::P_LIMIT}) : $this->limit);
        $this->recursive = empty($argv->{self::P_NO_RECURSIVE});
        $this->from = (array_key_exists(self::P_FROM, $argv) ? $argv->{self::P_FROM} : $this->from);
        $this->to = (array_key_exists(self::P_TO, $argv) ? strval($argv->{self::P_TO}) : $this->to);
        $this->from = array_unique(array_merge($this->from, array_slice($argv->positionedParameters(), 1)));
        $positionedParameters = $argv->positionedParameters();
        $this->executableName = (isset($positionedParameters[0]) ? $positionedParameters[0] : null);
    }

    private function splitSpaceSeparated(array $values)
    {
        $splitted = array();
        foreach ($values as $value) {
            $splitted = array_merge($splitted, preg_split('/[\\s,]+/', $value));
        }
        return array_unique($splitted);
    }

    private function decodeArgv(array $argv)
    {
        return Parameters::createFromArgv(
            $argv,
            self::parametersRequiringValues(),
            self::parametersUsableMultipleTimes()
        );
    }

    public function argv()
    {
        $parameters = new Parameters($this->encodeParameters());
        return $parameters->argv(
            self::parametersRequiringValues(),
            self::parametersUsableMultipleTimes()
        );
    }

    private function encodeParameters()
    {
        return array(
            0 => $this->executableName,
            self::P_HELP => $this->help,
            self::P_VERBOSE_LEVEL => $this->verboseLevel,
            self::P_LOG_FILE => $this->logFile,
            self::P_LOG_LEVEL => $this->logLevel,
            self::P_SIMULATE => $this->simulate,
            self::P_LIMIT => $this->limit,
            self::P_NO_RECURSIVE => !$this->recursive,
            self::P_FROM => $this->from,
            self::P_TO => $this->to,
        );
    }

    public static function parametersRequiringValues()
    {
        return array(
            self::P_VERBOSE_LEVEL,
            self::P_LOG_FILE,
            self::P_LOG_LEVEL,
            self::P_LIMIT,
            self::P_FROM,
            self::P_TO,
        );
    }

    public static function parametersUsableMultipleTimes()
    {
        return array(
            self::P_FROM,
        );
    }
}
