<?php defined('_JEXEC') or die('Restricted access');

class taInline
{
  var $_script = array();
  var $_scripts = array();
  var $_scriptsReady = array();
  // Во что будет обрамлен код, вызываемый в ready
  var $ready_prefix = '$(function(){';
  var $ready_postfix = '});';

  function &getInstance()
  {
    static $instance;

    if (!is_object($instance)) {
      $instance = new taInline();
    }

    return $instance;
  }

  function addScript($url, $type = "text/javascript")
  {
    $this->_script[$url] = $type;
  }

  function addScriptDeclaration($script)
  {
    $this->_scripts[] = $script;
  }

  function addScriptDeclarationReady($script)
  {
    $this->_scriptsReady[] = $script;
  }

  function getData()
  {
    ob_start();
    foreach ($this->_script as $url => $type) {
      echo '<script type="', $type, '" src="', $url, '"></script>', PHP_EOL;
    }

    if (sizeof($this->_scripts) || sizeof($this->_scriptsReady)) {
      echo '<script type="text/javascript">', PHP_EOL;
      foreach ($this->_scripts as $script) {
        echo $script, PHP_EOL;
      }
      if (sizeof($this->_scriptsReady)) {
        echo $this->ready_prefix, PHP_EOL;
        foreach ($this->_scriptsReady as $script) {
          echo $script, PHP_EOL;
        }
        echo $this->ready_postfix, PHP_EOL;
      }
      echo '</script>', PHP_EOL;
    }
    return ob_get_clean();
  }
}