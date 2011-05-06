<?php defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.file');

class plgSystemTainline extends JPlugin
{

  var $_path;

  function plgSystemTainline(&$subject, $config)
  {
    // путь к каталогу
    $this->_path = dirname(__FILE__) . DS . 'tainline' . DS;
    // регистрируем класс taInline
    JLoader::register('taInline', $this->_path . 'tainline.php');

    $filesource = $this->_path . 'libraries' . DS . 'inline.php';
    $filedest = JPATH_LIBRARIES . DS . 'joomla' . DS . 'document' . DS . 'html' . DS . 'renderer' . DS . 'inline.php';

    // проверяем наличие render-класса inline
    if (!file_exists($filedest)) { // если файла нет, то копируем его
      if (!(JFile::copy($filesource, $filedest))) {
        JError::raiseWarning(1, 'JInstaller::install: ' . JText::sprintf('Failed to copy file to', $filesource, $filedest));
        return false;
      }
    }
  }

}