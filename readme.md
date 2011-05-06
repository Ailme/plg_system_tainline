# taInline

Добавляет возможность использовать в шаблоне <jdoc:include type="inline" />
с возможностью добавления js скриптов и кодов в другое место html-документа, отличное от head

Например, если есть желание подключать js в конце html-шаблона, то нужно вставить <jdoc:include type="inline" /> в нужное место в шаблоне

* Пример использования

$inline = & taInline::getInstance();

$inline->addScript($url, $type);

$inline->addScriptDeclaration($script);

$inline->addScriptDeclarationReady($script);