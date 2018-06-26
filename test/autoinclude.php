<?php
/**
 * This class is used for autocomplete.
 * Class _AutoInclude
 * @noautoload
 * @generated by AutoLoadOne 1.0 generated 2018/06/25 06:46:35
 * @copyright Copyright Jorge Castro C - MIT License.
 */
class _AutoInclude
{
    var $debug=false;
    private $_arrautoincludeCustom = array(
		'MyProject\Connection' => '/../test/folder/multiplenamespace.php',
		'AnotherProject\Connection' => '/../test/folder/multiplenamespace.php',
		'MyProject\Connection2' => '/../test/folder/multiplenamespace2.php',
		'AnotherProject\Connection2' => '/../test/folder/multiplenamespace2.php',
		'ClassWithoutNameSpace' => '/../test/folder/subfolderalt/ClassWithoutNameSpace.php',
		'folder\subfolder\CustomClass' => '/../test/folder/subfolderalt/CustomClass.php',
		'ComposerAutoloaderInitfa359d287c4cb4296ff953e38b0f842a' => '/../vendor/composer/autoload_real.php',
		'Composer\Autoload\ComposerStaticInitfa359d287c4cb4296ff953e38b0f842a' => '/../vendor/composer/autoload_static.php'
    );
    private $_arrautoinclude = array(
		'folder' => '/../test/folder',
		'folder\subfolder' => '/../test/folder/subfolder',
		'sub\sub\sub' => '/../test/folder/subfolder/subsubfolder',
		'Composer\Autoload' => '/../vendor/composer'
    );
    /**
     * _AutoInclude constructor.
     * @param bool $debug
     */
    public function __construct(bool $debug=false)
    {
        $this->debug = $debug;
    }
    /**
     * @param $class_name
     * @throws Exception
     */
    public function auto($class_name) {
        // its called only if the class is not loaded.
        $ns = dirname($class_name); // without trailing
        $ns=($ns==".")?"":$ns;        
        $cls = basename($class_name);
        // special cases
        if (isset($this->_arrautoincludeCustom[$class_name])) {
            $this->loadIfExists($this->_arrautoincludeCustom[$class_name] );
            return;
        }
        // normal (folder) cases
        if (isset($this->_arrautoinclude[$ns])) {
            $this->loadIfExists($this->_arrautoinclude[$ns] . "\\" . $cls . ".php");
            return;
        }
    }

    /**
     * @param $filename
     * @throws Exception
     */
    public function loadIfExists($filename)
    {
        if (@file_exists(__DIR__."\\".$filename)) {
            include __DIR__."\\".$filename;
        } else {
            if ($this->debug) {
                throw  new Exception("AutoLoadOne Error: Loading file [".__DIR__."\\".$filename."] for class [".basename($filename)."]");
            } else {
                throw  new Exception("AutoLoadOne Error: No file found.");
            }
        }
    }
} // end of the class _AutoInclude
if (defined('_AUTOLOADONEDEBUG')) {
    $_autoInclude=new _AutoInclude(_AUTOLOADONEDEBUG);
} else {
    $_autoInclude=new _AutoInclude(false);
}
spl_autoload_register(function ($class_name)
{
    global $_autoInclude;
    $_autoInclude->auto($class_name);
});